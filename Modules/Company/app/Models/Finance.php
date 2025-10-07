<?php

namespace Modules\Company\Models;

use Modules\Company\Traits\BelongsToCompany;
use Modules\Core\Models\BaseModel;
use Modules\Core\Traits\Filterable;

class Finance extends BaseModel
{
  use BelongsToCompany, Filterable;

  protected $fillable = ['company_id', 'name', 'code', 'status'];
  protected static array $filterColumns = ['name', 'code', 'from_date', 'to_date'];
}
