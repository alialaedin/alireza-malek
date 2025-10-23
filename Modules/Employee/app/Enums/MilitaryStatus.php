<?php

namespace Modules\Employee\Enums;

use Modules\Core\Traits\HasCasesWithLabel;

enum MilitaryStatus: string
{
  use HasCasesWithLabel;
  
  case EXEMPTED = 'Exempted';
  case FINISHED = 'finished';
  case NOT_GONE = 'not_gone';
  case DOING = 'doing';

  public function label(): string
  {
    return match ($this) {
      self::DOING => 'در حال خدمت',
      self::EXEMPTED => 'معاف',
      self::FINISHED => 'تمام شده',
      self::NOT_GONE => 'نرفته',
    };
  }
}
