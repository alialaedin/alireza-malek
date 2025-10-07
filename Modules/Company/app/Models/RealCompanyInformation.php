<?php

namespace Modules\Company\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Company\Enums\ActivityLicense;
use Modules\Core\Models\BaseModel;

class RealCompanyInformation extends BaseModel
{
	protected $fillable = [
		'company_id',
		'full_name',
		'father_name',
		'national_code',
		'mobile',
		'address',
		'activity_license'
	];

	protected $casts = [
		'activity_license' => ActivityLicense::class,
	];

	public static function findByCompanyIdOrFail(int $companyId): self
	{
		return self::where('company_id', $companyId)->firstOrFail();
	}
	
	public function company(): BelongsTo
	{
		return $this->belongsTo(Company::class);
	}
}
