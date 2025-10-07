<?php

namespace Modules\FiscalYear\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;
use Modules\Core\Models\BaseModel;
use Modules\Core\Traits\HasCache;
use Modules\Core\Traits\PreventDeletionIfRelationsExist;
use Modules\PriceList\Models\PriceList;

class FiscalYear extends BaseModel
{
	use HasCache, PreventDeletionIfRelationsExist;
	
	protected $fillable = ['year', 'status'];
	protected $cacheKeys = ['all_fiscalYears'];
	protected $relationsPreventingDeletion = [
		'priceList' => 'به دلیل ایجاد نرخ نامه برای این سال قابل حذف نمی باشد'
	];

	public static function getAll(bool $onlyActives = false): Collection
	{
		$positions = Cache::rememberForever('all_fiscalYears', fn(): Collection => self::latest()->get());

		if ($onlyActives) {
			$positions = $positions->filter(fn(self $p): bool => $p->status === 1);
		}

		return $positions;
	}

	public function priceList(): HasMany
	{
		return $this->hasMany(PriceList::class);
	}
}
