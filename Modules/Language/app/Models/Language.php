<?php

namespace Modules\Language\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Modules\Core\Models\BaseModel;
use Modules\Core\Traits\HasCache;

class Language extends BaseModel
{
	use HasCache;

	protected $fillable = ['persian_name', 'english_name', 'code', 'native_name', 'status'];
	protected $cacheKeys = ['all_languages'];

	public static function getAll(bool $onlyActives = false, array $columns = ['*'])
	{
		$languages = Cache::rememberForever('all_languages', fn(): Collection => self::latest()->get($columns));

		if ($onlyActives) {
			$languages = $languages->filter(fn(self $p): bool => $p->status === 1);
		}

		return $languages;
	}
}
