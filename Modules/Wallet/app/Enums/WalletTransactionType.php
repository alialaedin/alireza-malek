<?php

namespace Modules\Wallet\Enums;

use Modules\Core\Traits\HasCasesWithLabel;

enum WalletTransactionType: string
{
  use HasCasesWithLabel;

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

}
