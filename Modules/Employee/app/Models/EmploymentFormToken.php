<?php

namespace Modules\Employee\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Core\Models\BaseModel;

class EmploymentFormToken extends BaseModel
{
	protected $fillable = ['employment_form_id', 'token', 'expired_at', 'verified_at'];

	public function employmentForm(): BelongsTo
	{
		return $this->belongsTo(EmploymentForm::class);
	}
}
