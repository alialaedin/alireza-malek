<?php

namespace Modules\Wallet\Enums;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

enum WalletTransactionType: string
{
  case DEPOSIT = "deposit";
  case WITHDRAW = "withdraw";

  public function label(): string
  {
    return match ($this) {
      self::DEPOSIT => 'شارژ',
      self::WITHDRAW => 'برداشت',
    };
  }

  public function color(): string
  {
    return match ($this) {
      self::DEPOSIT => 'info',
      self::WITHDRAW => 'danger',
    };
  }

  public static function getCasesWithLabel()
  {
    return Cache::rememberForever('all_wallet_tra_types', function () {
      return Arr::map(self::cases(), function (self $typo) {
        return [
          'name' => $typo->value,
          'label' => $typo->label()
        ];
      });
    });
  }
}
