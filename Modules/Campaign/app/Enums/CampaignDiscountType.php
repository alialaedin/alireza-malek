<?php

namespace Modules\Campaign\Enums;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

enum CampaignDiscountType: string
{
  case PERCENTAGE = 'percentage';
  case FLAT = 'flat';

  public function label(): string
  {
    return match ($this) {
      self::PERCENTAGE => 'درصد',
      self::FLAT => 'مبلغ ثابت',
    };
  }

  public function color(): string
  {
    return match ($this) {
      self::PERCENTAGE => 'secondary',
      self::FLAT => 'primary',
    };
  }

  public static function getCasesWithLabel(): array
  {
    return Cache::rememberForever('all_campaign_discount_types', function () {
      return Arr::map(self::cases(), function (self $type) {
        return [
          'name' => $type->value,
          'label' => $type->label()
        ];
      });
    });
  }
}
