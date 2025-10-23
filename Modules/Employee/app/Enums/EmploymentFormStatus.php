<?php

namespace Modules\Employee\Enums;

use Modules\Core\Traits\HasCasesWithLabel;

enum EmploymentFormStatus: string
{
  use HasCasesWithLabel;

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
}
