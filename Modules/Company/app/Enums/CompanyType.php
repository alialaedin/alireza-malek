<?php

namespace Modules\Company\Enums;

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
}
