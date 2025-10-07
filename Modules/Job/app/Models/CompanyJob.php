<?php

namespace Modules\Job\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Company\Traits\BelongsToCompany;
use Modules\Core\Models\BaseModel;
use Modules\Core\Traits\HasBooleanStatus;

class CompanyJob extends BaseModel
{
	use BelongsToCompany, HasBooleanStatus;

	protected $fillable = ['company_id', 'name', 'label', 'status'];

	public function duties(): BelongsToMany
	{
		return $this->belongsToMany(Duty::class);
	}
}
