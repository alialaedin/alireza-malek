<?php

namespace Modules\Contract\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
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

  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }
}
