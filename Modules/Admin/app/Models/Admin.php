<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Modules\Auth\Enums\GuardName;
use Modules\Core\Models\BaseAuthModel;
use Modules\Core\Traits\HasCache;

class Admin extends BaseAuthModel
{
	use HasCache;

	public const GUARD_NAME = GuardName::ADMIN->value;

	protected $fillable = ['name', 'username', 'email', 'password', 'mobile', 'remember_token'];
	protected $hidden = ['password', 'remember_token'];
	protected array $cacheKeys = ['all_admins'];

	public static function getAll(): Collection
	{
		return Cache::rememberForever('all_admins', fn() => self::latest()->get());
	}

	protected function password(): Attribute
	{
		return Attribute::make(
			set: fn($pass) => bcrypt($pass)
		);
	}
}
