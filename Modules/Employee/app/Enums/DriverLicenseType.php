<?php

namespace Modules\Employee\Enums;

use Modules\Core\Traits\HasCasesWithLabel;

enum DriverLicenseType: string
{
  use HasCasesWithLabel;
  
  case BASE_1 = 'base_1';
  case BASE_2 = 'base_2';
  case BASE_3 = 'base_3';
  case SPECIAL = 'special';
  case MOTORCYCLE = 'motorcycle';

  public function label(): string
  {
    return match ($this) {
      self::BASE_1 => 'پایه 1',
      self::BASE_2 => 'پایه 2',
      self::BASE_3 => 'پایه 3',
      self::SPECIAL => 'ویژه',
      self::MOTORCYCLE => 'موتور سیکلت',
    };
  }
}
