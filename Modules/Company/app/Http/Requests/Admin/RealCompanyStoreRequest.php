<?php

namespace Modules\Company\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Modules\Company\Enums\ActivityLicense;
use Modules\Core\Rules\IranMobile;

class RealCompanyStoreRequest extends FormRequest
{
	protected function prepareForValidation()
	{
		$this->merge([
			'login_status' => $this->boolean('login_status')
		]);
	}

	public function rules(): array
	{
		return [
			'username' => ['required', 'alpha_num', 'unique:companies'],
			'password' => ['required', 'string', Password::min(6), 'confirmed'],
			'full_name' => ['required', 'min:3', 'max:100'],
			'father_name' => ['required', 'min:3', 'max:100'],
			'national_code' => ['required', 'numeric', 'digits:10', 'unique:real_company_information'],
			'mobile' => ['required', 'numeric', 'digits:11', 'unique:real_company_information', new IranMobile()],
			'address' => ['required', 'min:3', 'max:1000'],
			'activity_license' => ['required', Rule::enum(ActivityLicense::class)],
			'login_status' => ['required', 'boolean']
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}
