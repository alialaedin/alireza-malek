<?php

namespace Modules\Contract\Enums;

use Illuminate\Support\Arr;

enum ContractStatus: string
{
  case PENDING = 'the contract';
  case ACTIVE = 'active';
  case EXPIRED = 'expired';
  case TERMINATED = 'terminated';

  public function label(): string
  {
    return match ($this) {
      self::PENDING => 'در حال بررسی',
      self::ACTIVE => 'فعال',
      self::EXPIRED => 'منقضی شده',
      self::TERMINATED => 'فسخ شده',
    };
  }

  public function color(): string
  {
    return match ($this) {
      self::PENDING => 'secondary',
      self::ACTIVE => 'success',
      self::EXPIRED => 'primary',
      self::TERMINATED => 'danger',
    };
  }

  public static function getCasesWithLabel(): array
  {
    return Arr::map(
      self::cases(),
      fn(self $status) =>
      [
        'name' => $status->value,
        'label' => $status->label()
      ]
    );
  }
}
