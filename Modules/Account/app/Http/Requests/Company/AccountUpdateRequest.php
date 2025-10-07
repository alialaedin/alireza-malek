<?php

namespace Modules\Account\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Auth\Enums\GuardName;
use Modules\Core\Helpers\Helpers;

class AccountUpdateRequest extends FormRequest
{
	protected function prepareForValidation()
	{
		$this->merge([
			'status' => $this->boolean('status')
		]);
	}

	public function rules(): array
	{
		$companyId = auth(GuardName::COMPANY->value)->id();
		$accountId = Helpers::getModelIdFromUrl('account');
		$baseRules = (new AccountStoreRequest())->rules();

		return [
			...$baseRules,
			'card_number' => [
				'required',
				'string',
				'numeric',
				'digits:16',
				Rule::unique('bank_accounts')->where('company_id', $companyId)->ignore($accountId),
			],
			'sheba_number' => [
				'required',
				'string',
				'numeric',
				Rule::unique('bank_accounts')->where('company_id', $companyId)->ignore($accountId)
			],
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
