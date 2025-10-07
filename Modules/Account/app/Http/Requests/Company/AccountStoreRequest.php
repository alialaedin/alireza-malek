<?php

namespace Modules\Account\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Auth\Enums\GuardName;

class AccountStoreRequest extends FormRequest
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

		return [
			'bank_name' => ['required', 'string', 'min:3', 'max:50'],
			'card_owner' => ['required', 'string', 'min:3', 'max:100'],
			'card_number' => [
				'required',
				'string',
				'numeric',
				'digits:16',
				Rule::unique('accounts')->where('company_id', $companyId),
			],
			'sheba_number' => [
				'required',
				'string',
				'numeric',
				Rule::unique('accounts')->where('company_id', $companyId)
			],
			'status' => ['required', 'boolean']
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
