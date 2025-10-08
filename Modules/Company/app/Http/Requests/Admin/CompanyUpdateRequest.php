<?php

namespace Modules\Company\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Modules\Company\Enums\CompanyType;
use Modules\Core\Rules\IranMobile;

class CompanyUpdateRequest extends FormRequest
{
	public function rules(): array
	{
		$nationalCodeDigits = $this->input('type') === CompanyType::REAL->value ? 10 : 11;
		$rules = (new CompanyStoreRequest())->rules();
		$ignore = Rule::unique('companies')->ignoreModel($this->route('company'));

		return [
			...$rules,
			'username' => ['required', 'alpha_num', $ignore],
			'password' => ['nullable', 'string', Password::min(6), 'confirmed'],
			'national_code' => ['required', 'numeric', "digits:$nationalCodeDigits", $ignore],
			'mobile' => ['required', 'numeric', 'digits:11', $ignore, new IranMobile()],
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}
