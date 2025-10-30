<?php

namespace Modules\Area\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Modules\Core\Models\BaseModel;
use Modules\Core\Traits\Filterable;
use Modules\Core\Traits\HasCache;

class City extends BaseModel
{
  use Filterable, HasCache;

  protected $fillable = ['name', 'province_id', 'status'];
  protected $cacheKeys = ['all-active-cities'];
  protected $with = ['province'];
  protected static array $filterColumns = ['name', 'province_id', 'from_date', 'to_date'];

  public static function getFilterInputs(): array
  {
    $filters = Arr::only(config('core.filters'), self::$filterColumns);
    $filters['name']['placeholder'] = 'عنوان شهر را وارد کنید';
    $filters['province_id']['options'] = Province::getAll()->pluck('name', 'id')->toArray();

    return $filters;
  }

  public static function getAllActive(): Collection
  {
    return Cache::rememberForever('all-active-cities', function () {
      return self::query()
        ->where('status', 1)
        ->orderBy('name')
        ->select(['id', 'name', 'province_id'])
        ->without('province')
        ->get();
    });
  }

  public function province(): BelongsTo
  {
    return $this->belongsTo(Province::class);
  }
}
