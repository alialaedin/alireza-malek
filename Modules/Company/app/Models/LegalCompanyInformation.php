<?php

namespace Modules\Company\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Core\Models\BaseModel;

class LegalCompanyInformation extends BaseModel
{
  public const ACCEPTED_IMAGE_MIMES = 'png,jpg,jpeg,webp';
  public const MAX_FILE_SIZE = '1024';

  protected $fillable = [
    'company_name',
    'managment_mobile',
    'brand',
    'national_id',
    'logo',
    'address',
    'workshop_code'
  ];

  public static function findByCompanyIdOrFail(int $companyId): self
  {
    return self::where('company_id', $companyId)->firstOrFail();
  }

  public function company(): BelongsTo
  {
    return $this->belongsTo(Company::class);
  }
}
