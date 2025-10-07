<?php

namespace Modules\Employee\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Arr;
use Modules\Company\Traits\BelongsToCompany;
use Modules\Core\Models\BaseModel;
use Modules\Core\Traits\Filterable;
use Modules\Core\Traits\HasBooleanStatus;
use Modules\Employee\Enums\EmploymentFormStatus;

class EmploymentForm extends BaseModel
{
	use BelongsToCompany, HasBooleanStatus, Filterable;

  protected $fillable = ['first_name', 'last_name', 'mobile', 'has_seen', 'is_filled', 'is_authenticated', 'company_id', 'status',
    'employment_form_id',
    'token',
    'expired_at',
    'verified_at'
  ];
	protected $appends = ['full_name'];
	protected $casts = ['status' => EmploymentFormStatus::class];

	protected $attributes = [
		'has_seen' => 0,
		'is_filled' => 0,
		'is_authenticated' => 0,
		'status' => EmploymentFormStatus::AWAITING_COMPLETION
	];
	protected static array $filterColumns = [
		'first_name',
		'last_name',
		'mobile',
		'has_seen',
		'is_filled',
		'status',
		'from_date',
		'to_date'
	];

	public static function getFilterInputs(): array
	{
		$filters = Arr::only(config('core.filters'), self::$filterColumns);
		$filters['status']['options'] = collect(EmploymentFormStatus::getCasesWithLabel())->pluck('label', 'name');

		return $filters;
	}

	protected function fullName(): Attribute
	{
		return Attribute::make(
			get: fn(): string => $this->attributes['first_name'] . ' ' . $this->attributes['last_name']
		);
	}

	public function employmentFormToken(): HasOne
	{
		return $this->hasOne(EmploymentFormToken::class);
	}
}
