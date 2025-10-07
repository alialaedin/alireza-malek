<?php

namespace Modules\Position\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;
use Modules\Company\Models\SignatureOwners;
use Modules\Core\Models\BaseModel;
use Modules\Core\Traits\HasCache;
use Modules\Core\Traits\PreventDeletionIfRelationsExist;

class Position extends BaseModel
{
	use HasCache, PreventDeletionIfRelationsExist;

	protected $fillable = ['title', 'en_title', 'status'];
	protected $attributes = ['status' => 1];
	protected array $cacheKeys = ['all_positions'];
	protected array $relationsPreventingDeletion = [
		'signatureOwners' => 'به دلیل نسبت داده شدن به صاحبان امضا قابل حذف نمی باشد'
	];

	public static function getAll(bool $onlyActives = true)
	{
		$positions = Cache::rememberForever('all_positions', fn(): Collection => self::latest()->get());

		if ($onlyActives) {
			$positions = $positions->filter(fn(self $p): bool => $p->status === 1);
		}

		return $positions;
	}

	public function signatureOwners(): HasMany
	{
		return $this->hasMany(SignatureOwners::class);
	}
}
