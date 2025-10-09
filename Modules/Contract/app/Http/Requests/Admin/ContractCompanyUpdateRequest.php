<?php

namespace Modules\Contract\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Campaign\Services\CampaignValidationService;
use Modules\Core\Helpers\Helpers;

class ContractCompanyUpdateRequest extends FormRequest
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
    $id = Helpers::getModelIdFromUrl('contract_company');
    $baseRules = (new ContractCompanyStoreRequest())->rules();

    return [
      ...$baseRules,
      'contract_number' => ['required', 'integer', Rule::unique('contract_companies', 'contract_number')->ignore($id)],
    ];
  }

  protected function passedValidation(): void
  {
    $contract = $this->route('contract_company');

    if ($this->filled('campaign_id') && $contract->campaign_id != $this->campaign_id) {
      CampaignValidationService::validate($this->campaign_id);
    }
  }

  public function authorize(): bool
  {
    return true;
  }
}
