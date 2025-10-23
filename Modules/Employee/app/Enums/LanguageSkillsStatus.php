<?php

namespace Modules\Employee\Enums;

use Modules\Core\Traits\HasCasesWithLabel;

enum LanguageSkillsStatus: string
{
  use HasCasesWithLabel;

  case EXCELLENT = 'excellent';
  case GOOD = 'good';
  case AVERAGE = 'average';

  public function label(): string
  {
    return match ($this) {
      self::EXCELLENT => 'عالی',
      self::GOOD => 'خوب',
      self::AVERAGE => 'متوسط',
    };
  }
}
