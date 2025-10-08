<?php

namespace Modules\Setting\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Modules\Core\Models\BaseMediaModel;
use Modules\Core\Traits\HasCache;
use Modules\Setting\Enums\SettingType;

class Setting extends BaseMediaModel
{
	use HasCache;

	protected $fillable = ['label', 'name', 'type', 'value', 'options'];
	protected $casts = ['type' => SettingType::class];
	protected $cacheKeys = ['settings'];
	protected array $collectionNames = ['setting_files' => 'file'];

	public static function getAllSettings(): Collection
	{
		return Cache::rememberForever('settings', callback: fn() => self::all());
	}

	public static function getFromName($name)
	{
		return self::getAllSettings()->where('name', $name)->first()?->value ?? null;
	}
}
