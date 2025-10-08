<?php

namespace Modules\Company\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Modules\Company\Enums\ActivityLicense;
use Modules\Company\Enums\CompanyType;
use Modules\Company\Models\Company;
use Modules\Core\Rules\IranMobile;

class CompanyStoreRequest extends FormRequest
{
	public function rules(): array
	{
		$nationalCodeDigits = $this->input('type') === CompanyType::REAL->value ? 10 : 11;
		
		return [
			'username' => ['required', 'alpha_num', 'unique:companies'],
			'password' => ['required', 'string', Password::min(6), 'confirmed'],
			'name' => ['required', 'min:3', 'max:100'],
			'national_code' => ['required', 'numeric', "digits:$nationalCodeDigits", 'unique:companies'],
			'mobile' => ['required', 'numeric', 'digits:11', 'unique:companies', new IranMobile()],
			'address' => ['required', 'min:3', 'max:1000'],
			'activity_license' => ['required', Rule::enum(ActivityLicense::class)],
			'login_status' => ['required', 'boolean'],
			'brand' => ['nullable', 'string', 'min:3', 'max:70'],
			'workshop_code' => ['nullable', 'numeric'],
			'logo' => [
				'nullable',
				'file',
				'mimes:' . Company::ACCEPTED_IMAGE_MIMES,
				'size:' . Company::MAX_FILE_SIZE
			],

			'signature_owners' => ['required', 'array'],
			'signature_owners.*.full_name' => ['required', 'string', 'min:3', 'max:70'],
			'signature_owners.*.mobile' => ['required', 'numeric', 'digits:11', new IranMobile()],
			'signature_owners.*.national_code' => ['required', 'numeric', 'digits:10'],
			'signature_owners.*.father_name' => ['required', 'string', 'min:3', 'max:70'],
			'signature_owners.*.position_id' => ['required', 'integer', 'exists:positions,id'],
			'signature_owners.*.has_right_to_sign' => ['required', 'boolean'],
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
