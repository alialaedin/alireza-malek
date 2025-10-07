<?php

namespace Modules\Company\Enums;

use Illuminate\Support\Arr;

enum ActivityLicense: string
{
  case HAVE = 'have';
  case HAVE_NOT = 'have_not';
  case IN_PROGRESS = 'in_progress';

  public function label(): string
  {
    return match ($this) {
      self::HAVE => 'دارد',
      self::HAVE_NOT => 'ندارد',
      self::IN_PROGRESS => 'در دست اقدام',
    };
  }

  public function color(): string
  {
    return match ($this) {
      self::HAVE => 'success',
      self::HAVE_NOT => 'danger',
      self::IN_PROGRESS => 'secondary',
    };
  }

  public static function getCasesWithLabel(): array
  {
    return Arr::map(
      self::cases(),
      fn(self $license) =>
      [
        'name' => $license->value,
        'label' => $license->label()
      ]
    );
  }
}
