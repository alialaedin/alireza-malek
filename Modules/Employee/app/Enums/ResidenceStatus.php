<?php

namespace Modules\Employee\Enums;

use Modules\Core\Traits\HasCasesWithLabel;

enum ResidenceStatus: string
{
  use HasCasesWithLabel;

  case TENANT = 'tenant';
  case OWNER  = 'owner';

  public function label(): string
  {
    return match ($this) {
      self::TENANT => 'استجاری',
      self::OWNER => 'شخصی',
    };
  }
}
