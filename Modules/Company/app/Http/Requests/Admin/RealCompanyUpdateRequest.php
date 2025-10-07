<?php

namespace Modules\Company\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Modules\Core\Rules\IranMobile;

class RealCompanyUpdateRequest extends FormRequest
{
	protected function prepareForValidation()
	{
		$this->merge([
			'login_status' => $this->boolean('login_status')
		]);
	}

	public function rules(): array
	{
		$company = $this->route('real_company');
		$id = $company->information->id;
		$rules = (new RealCompanyStoreRequest)->rules();

		return array_merge($rules, [
			'national_code' => ['required', 'numeric', 'digits:10', Rule::unique('real_company_information')->ignore($id)],
			'mobile' => ['required', 'numeric', new IranMobile(), Rule::unique('real_company_information')->ignore($id)],
			'username' => ['required', 'alpha_num', Rule::unique('companies')->ignoreModel($company)],
			'password' => ['nullable', 'string', Password::min(6), 'confirmed'],
		]);
	}

	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		return true;
	}
}
