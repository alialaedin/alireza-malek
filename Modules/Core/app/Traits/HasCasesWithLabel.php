<?php

namespace Modules\Core\Traits;

use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

trait HasCasesWithLabel
{
  /**
   * @throws Exception
   */
  protected static function bootHasCasesWithLabel(): void
  {
    if (!method_exists(static::class, 'label')) {
      throw new Exception("public function label() is not defined in " . static::class);
    }
  }

  public static function getCasesWithLabel(): array
  {
    $cacheKey = 'enum_cases_with_label_' . static::class;

    return Cache::rememberForever($cacheKey, function () {
      return Arr::map(static::cases(), function (self $item) {
        return [
          'name' => $item->value,
          'label' => $item->label()
        ];
      });
    });
  }
}
