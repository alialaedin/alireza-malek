<?php

namespace Modules\Job\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Arr;
use Modules\Company\Traits\BelongsToCompany;
use Modules\Core\Models\BaseModel;
use Modules\Core\Traits\Filterable;
use Modules\Core\Traits\HasBooleanStatus;
use Modules\Job\Enums\DutyType;

class Duty extends BaseModel
{
	use BelongsToCompany, HasBooleanStatus, Filterable;

	protected $fillable = ['company_id', 'type', 'title', 'description', 'status'];
	protected static array $filterColumns = ['type', 'title', 'status', 'description', 'from_date', 'to_date'];
	protected $casts = [
		'type' => DutyType::class
	];

	public static function getFilterInputs(): array
	{
		$filters = Arr::only(config('core.filters'), self::$filterColumns);

		$filters['type']['options'] = collect(DutyType::getCasesWithLabel())->pluck('label', 'name');
		$filters['type']['placeholder'] = 'برای انتخاب نوع وظیفه کلیک کنید';

		return $filters;
	}

	#[Scope]
	protected function private(Builder $query): void
	{
		$query->where('type', DutyType::PRIVATE);
	}

	#[Scope]
	protected function general(Builder $query): void
	{
		$query->where('type', DutyType::GENERAL);
	}

	public function duties(): BelongsToMany
	{
		return $this->belongsToMany(Duty::class);
	}
}
