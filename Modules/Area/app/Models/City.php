<?php

namespace Modules\Area\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Arr;
use Modules\Company\Models\Company;
use Modules\Contract\Enums\ContractStatus;
use Modules\Core\Models\BaseModel;
use Modules\Core\Traits\Filterable;

class City extends BaseModel
{
  use Filterable;

	protected $fillable = ['name', 'province_id', 'status'];
	protected $with = ['province'];
  protected static array $filterColumns = ['name', 'province_id', 'from_date', 'to_date'];

  public static function getFilterInputs(): array
  {
    $filters = Arr::only(config('core.filters'), self::$filterColumns);
    $filters['name']['placeholder'] = 'عنوان شهر را وارد کنید';
    $filters['province_id']['options'] = Province::getAll()->pluck('name', 'id')->toArray();

    return $filters;
  }

	public function province(): BelongsTo
	{
		return $this->belongsTo(Province::class);
	}
}
