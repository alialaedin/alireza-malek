<?php

namespace Modules\Account\Models;

use Modules\Company\Traits\BelongsToCompany;
use Modules\Core\Models\BaseModel;

class Account extends BaseModel
{
	use BelongsToCompany;

	protected $fillable = [
		'company_id',
		'bank_name',
		'card_owner',
		'card_number',
		'sheba_number',
		'status'
	];
}
