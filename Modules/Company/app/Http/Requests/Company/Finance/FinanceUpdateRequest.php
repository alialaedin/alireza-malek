<?php

namespace Modules\Company\Http\Requests\Company\Finance;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Auth\Enums\GuardName;
use Modules\Core\Helpers\Helpers;

class FinanceUpdateRequest extends FormRequest
{
	protected function passedValidation()
	{
		$this->merge([
			'status' => $this->boolean('status')
		]);
	}

	public function rules(): array
	{
		$companyId = auth(GuardName::COMPANY->value)->id();
		$financeId = Helpers::getModelIdFromUrl('finance');

		return [
			'name' => ['required', 'string', 'min:3', 'max:100'],
			'code' => [
				'required',
				'numeric',
				Rule::unique('finances')->where('company_id', $companyId)->ignore($financeId)
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
