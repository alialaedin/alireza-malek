<?php

namespace Modules\Employee\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Core\Models\BaseModel;

class Experience extends BaseModel
{
	protected $fillable = ['employee_id', 'workplace', 'post', 'start_date', 'end_date', 'basic_salary', 'last_salary', 'reason_for_leaving'];

	public function employee(): BelongsTo
	{
		return $this->belongsTo(Employee::class);
	}
}
