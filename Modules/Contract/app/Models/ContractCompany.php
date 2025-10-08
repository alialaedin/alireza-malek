<?php

namespace Modules\Contract\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Arr;
use Modules\Company\Models\Company;
use Modules\Contract\Enums\ContractStatus;
use Modules\Core\Models\BaseMediaModel;
use Modules\Core\Traits\Filterable;

class ContractCompany extends BaseMediaModel
{
  use Filterable;

  const ACCEPT_FILE_MIME = 'pdf,doc,docx';
  const MAX_FILE_SIZE = '5000';

  protected $fillable = [
    'company_id',
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
  protected array $collectionNames = ['contract_company_files' => 'file'];
  protected static array $filterColumns = [ 'company_id', 'contract_number', 'subject', 'status', 'from_date', 'to_date'];

  public static function getFilterInputs(): array
  {
    $filters = Arr::only(config('core.filters'), self::$filterColumns);

    $filters['status']['options'] = collect(ContractStatus::getCasesWithLabel())->pluck('label', 'name')->toArray();
    $filters['status']['placeholder'] = 'وضعیت قرارداد را انتخاب کنید';
    $filters['company_id']['options'] = Company::getAllCompanies()->pluck('title', 'id')->toArray();

    return $filters;
  }

  public function company(): BelongsTo
  {
    return $this->belongsTo(Company::class);
  }
}
