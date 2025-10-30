<?php

namespace Modules\Employee\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Core\Models\BaseModel;

class EmployeeProfile extends BaseModel
{
	protected $fillable = [
		'employee_id',
		'father_name',
		'login_status',
		'identity_card_number',
		'identity_card_serial_number',
		'birth_place',
		'birth_date',
		'national_code',
		'nationality',
		'religion',
		'is_married',
		'spouse_job',
		'children_count',
		'custody_of_children',
		'telephone',
		'residence_status',
		'postal_code',
		'address',
		'city_id',
		'military_status',
		'reason_for_exemption',
		'has_own_car',
		'car_type',
		'has_driver_license',
		'driver_license_type',
		'driver_license_number',
		'health_status',
		'disease',
		'has_surgery',
		'cause_of_surgery',
		'has_other_income',
		'other_income_source',
		'other_income_amount'
	];

	public function employee(): BelongsTo
	{
		return $this->belongsTo(Employee::class);
	}
}
