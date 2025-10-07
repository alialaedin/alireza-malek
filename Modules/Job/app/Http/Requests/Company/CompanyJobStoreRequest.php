<?php

namespace Modules\Job\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Auth\Enums\GuardName;

class CompanyJobStoreRequest extends FormRequest
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
			'name' => ['required', 'min:3', 'max:50', Rule::unique('company_jobs')->where('company_id', $companyId)],
			'label' => ['required', 'min:3', 'max:50'],
			'status' => ['required', 'boolean']
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}
