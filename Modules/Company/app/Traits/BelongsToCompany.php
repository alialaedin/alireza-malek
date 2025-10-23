<?php

namespace Modules\Company\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Modules\Auth\Enums\GuardName;
use Modules\Company\Models\Company;

trait BelongsToCompany
{
  public static function bootBelongsToCompany(): void
  {
    static::addGlobalScope('companyScope', function ($query) {
      $companyId = Auth::guard(GuardName::COMPANY->value)->id();
      if ($companyId) {
        $query->where('company_id', $companyId);
      }
    });

    static::creating(function (Model $model) {
      $companyId = Auth::guard(GuardName::COMPANY->value)->id();
      if ($companyId && empty($model->company_id)) {
        $model->company_id = $companyId;
      }
    });
  }

  public function initializeBelongsToCompany(): void
  {
    $this->append('company_name');
  }

  public function company(): BelongsTo
  {
    return $this->belongsTo(Company::class);
  }

  protected function companyName(): Attribute
  {
    return Attribute::make(
      get: fn(): string => optional($this->company)->name ?? ''
    );
  }
}
