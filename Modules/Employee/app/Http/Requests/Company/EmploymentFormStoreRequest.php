<?php

namespace Modules\Employee\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Auth\Enums\GuardName;
use Modules\Core\Rules\IranMobile;

class EmploymentFormStoreRequest extends FormRequest
{
	public function rules(): array
	{
		$companyId = auth(GuardName::COMPANY->value)->id();

		return [
			'first_name' => ['required', 'string', 'min:3'],
			'last_name' => ['required', 'string', 'min:3'],
			'mobile' => [
				'required', 
				'numeric', 
				'digits:11', 
				'starts_with:09', 
				Rule::unique('employment_forms')->where('company_id', $companyId), 
				new IranMobile()]
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}
