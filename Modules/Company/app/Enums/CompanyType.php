<?php

namespace Modules\Company\Enums;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

enum CompanyType: string
{
  case REAL = 'real';
  case LEGAL = 'legal';

  public function label(): string
  {
    return match ($this) {
      self::REAL => 'حقیقی',
      self::LEGAL => 'حقوقی',
    };
  }

  public function color(): string
  {
    return match ($this) {
      self::REAL => 'warning',
      self::LEGAL => 'info',
    };
  }

  public static function getCasesWithLabel(): array
  {
    return Cache::rememberForever('all_company_types', function () {
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
