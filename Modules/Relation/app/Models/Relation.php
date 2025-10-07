<?php

namespace Modules\Relation\Models;

use Modules\Company\Traits\BelongsToCompany;
use Modules\Core\Models\BaseModel;

class Relation extends BaseModel
{
	use BelongsToCompany;

	protected $fillable = ['company_id', 'name', 'status'];
}
