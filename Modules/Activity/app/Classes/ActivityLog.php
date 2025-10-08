<?php

namespace Modules\Activity\Classes;

use Illuminate\Database\Eloquent\Model;
use Modules\Activity\Enums\EventType;

class ActivityLog
{
	private static Model $model;
	private ?string $description;

	public static function model(Model $modelInstance): self
	{
		$instance = new self();
		$instance->model = $modelInstance;
		
		return $instance;
	}

	public function created(?string $description = null): void
	{
		$this->description = $description;
		$this->log(EventType::CREATE);
	}

	public function updated(?string $description = null): void
	{
		$changes = self::$model->getChanges();
		unset($changes['updated_at']);

		if (empty($changes)) {
			return;
		}

		$this->description = $description;
		$this->log(EventType::UPDATE, ['changedColumns' => $changes]);
	}

	public function deleted(?string $description = null): void
	{
		$original = self::$model->getOriginal();

		$this->description = $description;
		$this->log(EventType::DELETE, ['originalColumns' => $original]);
	}

	private function log(EventType $event, array $properties = []): void
	{
		activity()
			->causedBy(auth()->id())
			->event($event->value)
			->performedOn(self::$model)
			->when(!empty($properties), fn($log) => $log->withProperties($properties))
			->log($this->resolveDescription($event));
	}

	private function resolveDescription(EventType $event): string
	{
		if ($this->description) {
			return $this->description;
		}

		$modelClass = get_class(self::$model);
		$modelName = config('models.' . $modelClass, class_basename($modelClass));

		return match ($event) {
			EventType::CREATE => "{$modelName} ایجاد شد",
			EventType::UPDATE => "{$modelName} بروز شد",
			EventType::DELETE => "{$modelName} حذف شد",
			default => 'فعالیت انجام شد',
		};
	}
}
