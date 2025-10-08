<?php

namespace Modules\Campaign\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;
use Modules\Campaign\Enums\CampaignDiscountType;
use Modules\Contract\Models\ContractCompany;
use Modules\Core\Models\BaseModel;
use Modules\Core\Traits\Filterable;
use Modules\Core\Traits\HasCache;
use Modules\Core\Traits\PreventDeletionIfRelationsExist;

class Campaign extends BaseModel
{
	use Filterable, HasCache, PreventDeletionIfRelationsExist;

	protected $fillable = [
		'title',
		'start_date',
		'end_date',
		'description',
		'discount_type',
		'discount_amount',
		'is_active',
		'usage_limit',
		'used_count'
	];

	protected $casts = ['discount_type' => CampaignDiscountType::class];
	protected $attributes = ['used_count' => 0];
	protected $appends = ['is_expired'];
	protected $cacheKeys = ['active_campaings'];
	protected $relationsPreventingDeletion = ['contractCompanies' => 'به دلیل استفاده در قرارداد قابل حذف نمی باشد'];
	protected static $filterColumns = ['title', 'discount_type', 'from_date', 'to_date'];

	public static function getActiveCampaigns(): Collection
	{
		return Cache::rememberForever('active_campaigns', function (): Collection {

			$fillable = (new self)->getFillable();
			$selectedColumns = array_diff($fillable, ['description']);

			array_unshift($selectedColumns, 'id');

			return self::query()
				->select($selectedColumns)
				->where('is_active', true)
				->whereColumn('used_count', '<=', 'usage_limit')
				->whereDate('start_date', '<=', now())
				->whereDate('end_date', '>=', now())
				->latest()
				->get();
		});
	}

	protected function isExpired(): Attribute
	{
		return Attribute::make(
			get: fn(): bool => Carbon::now()->gt($this->end_date)
		);
	}

	public function contractCompanies(): HasMany
	{
		return $this->hasMany(ContractCompany::class);
	}
}
