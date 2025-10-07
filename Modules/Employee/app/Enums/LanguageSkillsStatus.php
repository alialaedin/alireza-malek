<?php

namespace Modules\Employee\Enums;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

enum LanguageSkillsStatus: string
{
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

  public static function getCasesWithLabel(): array
  {
    return Cache::rememberForever(
      'all_language_skills',
      fn() => Arr::map(
        self::cases(),
        fn(self $skill) => [
          'name' => $skill->value,
          'label' => $skill->label()
        ]
      )
    );
  }
}
