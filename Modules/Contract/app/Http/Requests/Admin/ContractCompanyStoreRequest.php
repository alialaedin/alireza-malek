<?php

namespace Modules\Contract\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Campaign\Services\CampaignValidationService;
use Modules\Contract\Enums\ContractStatus;
use Modules\Contract\Models\ContractCompany;
use Modules\Core\Helpers\Helpers;

class ContractCompanyStoreRequest extends FormRequest
{
  protected function prepareForValidation(): void
  {
    $this->merge([
      'payment_amount' => Helpers::removeComma($this->input('payment_amount')),
      'guarantee_amount' => Helpers::removeComma($this->input('guarantee_amount')),
    ]);
  }

  public function rules(): array
  {
    return [
      'company_id' => ['required', 'integer', 'exists:companies,id'],
      'campaign_id' => ['nullable', 'integer', 'exists:campaigns,id'],
      'contract_number' => ['required', 'integer', 'unique:contract_companies,contract_number'],
      'subject' => ['required', 'string', 'max:190'],
      'payment_amount' => ['required', 'numeric', 'min:0'],
      'start_date' => ['required', 'date', 'before_or_equal:end_date'],
      'end_date' => ['required', 'date', 'after_or_equal:start_date'],
      'status' => ['required', Rule::enum(ContractStatus::class)],
      'guarantee_amount' => ['required', 'numeric', 'min:0'],
      'terms' => ['required', 'string'],
      'payment_terms' => ['required', 'string'],
      'signature_date_company' => ['nullable', 'date', 'before_or_equal:start_date'],
      'signature_date_webmaster' => ['nullable', 'date', 'before_or_equal:start_date'],
      'file' => ['nullable', 'file', 'mimes:' . ContractCompany::ACCEPT_FILE_MIME, 'max:' . ContractCompany::MAX_FILE_SIZE],
      'notes' => ['nullable', 'string'],
    ];
  }

  protected function passedValidation()
  {
    if ($this->filled('campaign_id')) {
      CampaignValidationService::validate($this->campaign_id);
    }
  }

  public function authorize(): bool
  {
    return true;
  }
}
