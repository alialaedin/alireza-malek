<?php

namespace Modules\Employee\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Core\Models\BaseModel;

class EducationCertificate extends BaseModel
{
	protected $fillable = ['employee_id', 'degree', 'field_of_study', 'university', 'degree_obtained_at', 'place_of_obtaining_degree'];

	public function employee(): BelongsTo
	{
		return $this->belongsTo(Employee::class);
	}
}
