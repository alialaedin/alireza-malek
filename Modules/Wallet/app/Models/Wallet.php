<?php

namespace Modules\Wallet\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Modules\Core\Models\BaseModel;

class Wallet extends BaseModel
{
	protected $fillable = ['holder_id', 'holder_type', 'main_balance', 'gift_balance'];
	protected $appends = ['balance'];

	protected $attributes = [
		'main_balance' => 0,
		'gift_balance' => 0
	];

	protected function balance(): Attribute
	{
		return Attribute::make(
			get: fn(): int => $this->main_balance + $this->gift_balance
		);
	}

	public function holder(): MorphTo
	{
		return $this->morphTo();
	}

	public function transactions(): HasMany
	{
		return $this->hasMany(WalletTransaction::class, 'wallet_id');
	}
}
