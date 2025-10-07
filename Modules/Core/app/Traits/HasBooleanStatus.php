<?php

namespace Modules\Core\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasBooleanStatus
{

	public function initializeHasBooleanStatus(): void
	{
		$this->append(['status_label', 'status_color']);
	}

	protected function statusLabel(): Attribute
	{
		return Attribute::make(
			get: fn(): string => $this->status ? 'فعال' : 'غیر فعال'
		);
	}

	protected function statusColor(): Attribute
	{
		return Attribute::make(
			get: fn(): string => $this->status ? 'success' : 'danger'
		);
	}
}
