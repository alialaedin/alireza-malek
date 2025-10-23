<?php

namespace Modules\Employee\Enums;

use Modules\Core\Traits\HasCasesWithLabel;

enum CarType: string
{
  use HasCasesWithLabel;

  case MICRO = 'micro';
  case HATCHBACK = 'hatchback';
  case CROSSOVER = 'crossover';
  case SEDAN = 'sedan';
  case SUV = 'suv';
  case VAN = 'van';
  case MINI_VAN = 'mini_van';
  case GT = 'gt';
  case CABRIOLET = 'cabriolet';
  case LIMOUSINE = 'limousine';

  public function label(): string
  {
    return match ($this) {
      self::MICRO => 'خودرو مینی',
      self::HATCHBACK => 'هاچبک',
      self::CROSSOVER => 'کراس اوور',
      self::SEDAN => 'سدان',
      self::SUV => 'شاسی بلند',
      self::VAN => 'ون',
      self::MINI_VAN => 'مینی ون',
      self::GT => 'گرندتورر ',
      self::CABRIOLET => 'بدون سقف',
      self::LIMOUSINE => 'لیموزین',
    };
  }
}
