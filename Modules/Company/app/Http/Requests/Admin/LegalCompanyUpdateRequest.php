<?php

namespace Modules\Company\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Modules\Company\Enums\ContractStatus;
use Modules\Core\Rules\IranMobile;

class LegalCompanyUpdateRequest extends FormRequest
{

	public function rules(): array
	{
		$company = $this->route('legal_company');
		$infoId = $company->information->id;

		$baseRules = (new LegalCompanyStoreRequest())->rules();

		return [
			...$baseRules,
			'contract_status' => ['required', Rule::enum(ContractStatus::class)],
			'username' => ['required', 'alpha_num', Rule::unique('companies')->ignoreModel($company)],
			'password' => ['nullable', 'string', Password::min(6), 'confirmed'],
			'managment_mobile' => ['required', 'numeric', 'digits:11', new IranMobile(), Rule::unique('legal_company_information')->ignore($infoId)],
			'national_id' => ['required', 'numeric', 'digits:11', Rule::unique('legal_company_information')->ignore($infoId)],
			'signature_owners.*.id' => ['nullable', 'integer', 'exists:signature_owners,id'],
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
