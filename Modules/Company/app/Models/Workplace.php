<?php

namespace Modules\Company\Models;

use Modules\Company\Traits\BelongsToCompany;
use Modules\Core\Models\BaseModel;

class Workplace extends BaseModel
{
	use BelongsToCompany;

	protected $fillable = ['company_id', 'title', 'address', 'status'];
}
