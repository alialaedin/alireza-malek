<?php

namespace Modules\Employee\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Core\Models\BaseModel;
use Modules\Relation\Models\Relation;

class ReferencePerson extends BaseModel
{
	protected $fillable = ['employee_id', 'relation_id', 'first_name', 'last_name', 'mobile', 'job', 'address'];

	public function employee(): BelongsTo
	{
		return $this->belongsTo(Employee::class);
	}

	public function relation(): BelongsTo
	{
		return $this->belongsTo(Relation::class);
	}
}
