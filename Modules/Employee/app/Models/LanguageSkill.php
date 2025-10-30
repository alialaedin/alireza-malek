<?php

namespace Modules\Employee\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Core\Models\BaseModel;
use Modules\Language\Models\Language;

class LanguageSkill extends BaseModel
{
	protected $fillable = ['employee_id', 'language_id', 'conversation', 'reading', 'writing'];

	public function employee(): BelongsTo
	{
		return $this->belongsTo(Employee::class);
	}

	public function language(): BelongsTo
	{
		return $this->belongsTo(Language::class);
	}
}
