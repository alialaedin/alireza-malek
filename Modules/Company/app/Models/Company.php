<?php

namespace Modules\Company\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Modules\Account\Models\Account;
use Modules\Company\Enums\CompanyType;
use Modules\Contract\Models\ContractCompany;
use Modules\Core\Models\BaseAuthMediaModel;
use Modules\Core\Traits\Filterable;
use Modules\Core\Traits\HasCache;
use Modules\Employee\Models\EmploymentForm;
use Modules\Job\Models\CompanyJob;
use Modules\PriceList\Models\PriceList;
use Modules\Relation\Models\Relation;
use Modules\Wallet\Traits\HasWallet;

class Company extends BaseAuthMediaModel
{
  use HasCache, HasWallet, Filterable;

  public const ACCEPTED_IMAGE_MIMES = 'png,jpg,jpeg,webp';
  public const MAX_FILE_SIZE = '1024';

  protected $fillable = [
    'username',
    'password',
    'type',
    'login_status',
    'name',
    'mobile',
    'national_code',
    'address',
    'activity_license',
    'brand',
    'workshop_code'
  ];

  protected $hidden = ['password', 'remember_token'];
  protected $casts = ['type' => CompanyType::class];
  protected array $cacheKeys = ['all_companies'];
  protected array $collectionNames = ['company_logos' => 'logo'];
  protected static array $filterColumns = ['username', 'type', 'name', 'mobile', 'national_code', 'workshop_code', 'from_date', 'to_date'];

  public static function getFilterInputs(): array
  {
    $filters = Arr::only(config('core.filters'), self::$filterColumns);

    $filters['name']['placeholder'] = 'نام را اینجا وارد کنید';
    $filters['type']['placeholder'] = 'نوع شرکت را انتخاب کنید';
    $filters['type']['options'] = collect(CompanyType::getCasesWithLabel())->pluck('label', 'name');

    return $filters;
  }

  public static function getAllCompanies(): Collection
  {
    return Cache::rememberForever('all_companies', function () {
      return self::query()
        ->select(['id', 'type', 'name', 'mobile'])
        ->latest('id')
        ->get()
        ->map(fn(self $company) => [
          'id' => $company->id,
          'type' => $company->type->label(),
          'title' => $company->name . ' - ' . $company->mobile,
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
