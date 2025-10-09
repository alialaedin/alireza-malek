<?php

namespace Modules\Contract\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Modules\Campaign\Models\Campaign;
use Modules\Company\Models\Company;
use Modules\Contract\Enums\ContractStatus;
use Modules\Contract\Services\Admin\ContractService;
use Modules\Core\Models\BaseMediaModel;
use Modules\Core\Traits\Filterable;

class ContractCompany extends BaseMediaModel
{
  use Filterable;

  public const ACCEPT_FILE_MIME = 'pdf,doc,docx';
  public const MAX_FILE_SIZE = '5000';

  protected $fillable = [
    'company_id',
    // 'campaign_id',
    'contract_number',
    'subject',
    'start_date',
    'end_date',
    'terms',
    'status',
    'payment_terms',
    'payment_amount',
    'signature_date_company',
    'signature_date_webmaster',
    'notes',
    'guarantee_amount',
  ];

  protected $casts = ['status' => ContractStatus::class];
  protected $appends = ['final_amount'];
  protected $with = [
    'campaign:id,discount_type,discount_amount,title',
    'company:id,type,name,mobile'
  ];
  
  protected array $collectionNames = ['contract_company_files' => 'file'];
  protected static array $filterColumns = ['company_id', 'contract_number', 'subject', 'status', 'from_date', 'to_date'];

  public static function getFilterInputs(): array
  {
    $filters = Arr::only(config('core.filters'), self::$filterColumns);

    $filters['status']['options'] = collect(ContractStatus::getCasesWithLabel())->pluck('label', 'name')->toArray();
    $filters['status']['placeholder'] = 'وضعیت قرارداد را انتخاب کنید';
    $filters['company_id']['options'] = Company::getAllCompanies()->pluck('title', 'id')->toArray();

    return $filters;
  }

  protected function finalAmount(): Attribute
  {
    return Attribute::make(
      get: fn(): int => ContractService::calculateFinalAmount($this)
    );
  }

  public function company(): BelongsTo
  {
    return $this->belongsTo(Company::class);
  }

  public function campaign(): BelongsTo
  {
    return $this->belongsTo(Campaign::class);
  }
}
