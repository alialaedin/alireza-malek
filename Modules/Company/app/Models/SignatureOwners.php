<?php

namespace Modules\Company\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Core\Models\BaseModel;
use Modules\Position\Models\Position;

class SignatureOwners extends BaseModel
{
	protected $fillable = [
		'company_id',
		'position_id',
		'full_name',
		'national_code',
		'mobile',
		'father_name',
		'has_right_to_sign'
	];

	public function company(): BelongsTo
	{
		return $this->belongsTo(Company::class);
	}
	
	public function position(): BelongsTo
	{
		return $this->belongsTo(Position::class);
	}
}
