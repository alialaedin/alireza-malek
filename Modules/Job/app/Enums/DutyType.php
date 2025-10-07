<?php

namespace Modules\Job\Enums;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

enum DutyType: string
{
  case GENERAL = 'general';
  case PRIVATE = 'private';

  public function label(): string
  {
    return match ($this) {
      self::GENERAL => 'عمومی',
      self::PRIVATE => 'خصوصی',
    };
  }

  public function color(): string
  {
    return match ($this) {
      self::GENERAL => 'info',
      self::PRIVATE => 'warning',
    };
  }

  public static function getCasesWithLabel(): array
  {
    return Cache::rememberForever('all_duty_types', function () {
      return Arr::map(
        self::cases(),
        fn(self $type) =>
        [
          'name' => $type->value,
          'label' => $type->label()
        ]
      );
    });
  }
}
