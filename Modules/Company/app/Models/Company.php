<?php

namespace Modules\Company\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Modules\Account\Models\Account;
use Modules\Company\Enums\CompanyType;
use Modules\Company\Enums\ContractStatus;
use Modules\Contract\Models\ContractCompany;
use Modules\Core\Models\BaseAuthModel;
use Modules\Core\Traits\HasCache;
use Modules\Employee\Models\EmploymentForm;
use Modules\Job\Models\CompanyJob;
use Modules\PriceList\Models\PriceList;
use Modules\Relation\Models\Relation;
use Modules\Wallet\Traits\HasWallet;

class Company extends BaseAuthModel
{
  use HasCache, HasWallet;

  protected $fillable = ['username', 'password', 'remember_token', 'type', 'login_status', 'contract_status'];
  protected $hidden = ['password', 'remember_token'];
  protected $appends = ['information'];
  protected array $cacheKeys = ['all_companies'];

  protected $attributes = [
    'contract_status' => ContractStatus::ON_HOLD,
    'login_status' => 1
  ];

  protected $casts = [
    'type' => CompanyType::class,
    'contract_status' => ContractStatus::class,
  ];

  public static function getAllCompanies(): Collection
  {
    return Cache::rememberForever('all_companies', function () {
      return self::query()
        ->select(['id', 'type'])
        ->latest('id')
        ->get()
        ->map(fn(self $company) => [
          'id' => $company->id,
          'type' => $company->type->label(),
          'title' => $company->getName() . ' - ' . $company->getMobile(),
        ]);
    });
  }

  #[Scope]
  protected function real(Builder $builder): void
  {
    $builder->where('type', '=', CompanyType::REAL);
  }

  #[Scope]
  protected function legal(Builder $builder): void
  {
    $builder->where('type', '=', CompanyType::LEGAL);
  }

  protected function password(): Attribute
  {
    return Attribute::make(
      set: fn($pass) => bcrypt($pass)
    );
  }

  protected function information(): Attribute
  {
    return Attribute::make(
      get: fn(): RealCompanyInformation|LegalCompanyInformation => match ($this->type) {
        CompanyType::REAL => $this->hasOne(RealCompanyInformation::class, 'company_id')->first(),
        CompanyType::LEGAL => $this->hasOne(LegalCompanyInformation::class, 'company_id')->first(),
      }
    );
  }

  protected function holderName(): Attribute
  {
    return Attribute::make(
      get: fn(): string => $this->getName()
    );
  }

  protected function holderMobile(): Attribute
  {
    return Attribute::make(
      get: fn(): string => $this->getMobile()
    );
  }

  public function getName(): string
  {
    return $this->information->company_name ?? $this->information->full_name;
  }

  public function getMobile(): string
  {
    return $this->information->managment_mobile ?? $this->information->mobile;
  }

  public function signatureOwners(): HasMany
  {
    return $this->hasMany(SignatureOwners::class);
  }

  public function contractCompanies(): HasMany
  {
    return $this->hasMany(ContractCompany::class);
  }

  public function priceList(): HasMany
  {
    return $this->hasMany(PriceList::class);
  }

  public function relations(): HasMany
  {
    return $this->hasMany(Relation::class);
  }

  public function finances(): HasMany
  {
    return $this->hasMany(Finance::class);
  }

  public function accounts(): HasMany
  {
    return $this->hasMany(Account::class);
  }

  public function workplaces(): HasMany
  {
    return $this->hasMany(Workplace::class);
  }

  public function jobs(): HasMany
  {
    return $this->hasMany(CompanyJob::class);
  }

  public function employmentForms(): HasMany
  {
    return $this->hasMany(EmploymentForm::class);
  }
}
