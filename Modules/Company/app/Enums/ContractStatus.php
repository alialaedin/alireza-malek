<?php

namespace Modules\Company\Enums;

use Illuminate\Support\Arr;

enum ContractStatus: string
{
  case FINISHED = 'finished';
  case ON_HOLD = 'on_hold';
  case IN_PROCESS = 'in_process';
  case DISSOCIATE = 'dissociate ';

  public function label(): string
  {
    return match ($this) {
      self::FINISHED => 'اتمام قرارداد',
      self::ON_HOLD => 'در حال بررسی',
      self::IN_PROCESS => 'در جریان',
      self::DISSOCIATE => 'قطع همکاری',
    };
  }

  public function color(): string
  {
    return match ($this) {
      self::FINISHED => 'dark',
      self::ON_HOLD => 'warning',
      self::IN_PROCESS => 'success',
      self::DISSOCIATE => 'danger',
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
