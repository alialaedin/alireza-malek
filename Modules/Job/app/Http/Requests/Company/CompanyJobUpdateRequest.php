<?php

namespace Modules\Job\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Auth\Enums\GuardName;
use Modules\Core\Helpers\Helpers;

class CompanyJobUpdateRequest extends FormRequest
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
		$jobId = Helpers::getModelIdFromUrl('job');
		$rules = (new CompanyJobStoreRequest())->rules();

		return [
			...$rules,
			'name' => [
				'required', 
				'min:3', 
				'max:50', 
				Rule::unique('company_jobs')->where('company_id', $companyId)->ignore($jobId)
			]
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}
