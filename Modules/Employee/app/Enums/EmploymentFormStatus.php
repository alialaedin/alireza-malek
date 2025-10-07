<?php

namespace Modules\Employee\Enums;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

enum EmploymentFormStatus: string
{
  case CONFIRMED = 'confirmed';
  case REJECTED = 'rejected';
  case AWAITING_REVIEW = 'awaiting_review';
  case AWAITING_COMPLETION = 'awaiting_completion';

  public function label(): string
  {
    return match ($this) {
      self::CONFIRMED => 'تایید شده',
      self::AWAITING_REVIEW => 'در انتظار بررسی',
      self::AWAITING_COMPLETION => 'در انتظار تکمیل',
      self::REJECTED => 'رد شده',
    };
  }

  public function color(): string
  {
    return match ($this) {
      self::CONFIRMED => 'success',
      self::AWAITING_REVIEW => 'warning',
      self::AWAITING_COMPLETION => 'primary',
      self::REJECTED => 'danger',
    };
  }

  public static function getCasesWithLabel(): array
  {
    return Cache::rememberForever(
      'all_employment_form_statuses',
      fn() => Arr::map(
        self::cases(),
        fn(self $status) => [
          'name' => $status->value,
          'label' => $status->label()
        ]
      )
    );
  }
}
