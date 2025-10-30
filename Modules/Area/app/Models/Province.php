<?php

namespace Modules\Area\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;
use Modules\Core\Models\BaseModel;
use Modules\Core\Traits\Filterable;
use Modules\Core\Traits\HasCache;

class Province extends BaseModel
{
	use HasCache, Filterable;

	protected $fillable = ['name', 'status'];
	protected $cacheKeys = ['all-provinces', 'all-provinces-with-cities'];
	protected $withCount = ['cities'];
  protected static array $filterColumns = ['name', 'status', 'from_date', 'to_date'];

	public static function getAll(bool $onlyActives = true)
	{
		$provinces = Cache::rememberForever('all-provinces', fn(): Collection => self::latest()->get());

		if ($onlyActives) {
			$provinces = $provinces->filter(fn(self $p): bool => $p->status === 1);
		}

		return $provinces;
	}

	public static function getProvincesWithCities()
	{
		return Cache::rememberForever('all-provinces-with-cities', function() {
			return self::query()
				->where('status', 1)
				->select(['id', 'name'])
				->orderBy('name')
				->with([
					'cities' => function ($query) {
						$query->where('status', 1);
						$query->orderBy('name');
						$query->select(['id', 'name']);
					}
				])
				->get();
		});
	}

	public function isDeletable(): bool
	{
		return $this->cities_count == 0;
	}

	public function cities(): HasMany
	{
		return $this->hasMany(City::class);
	}
}
