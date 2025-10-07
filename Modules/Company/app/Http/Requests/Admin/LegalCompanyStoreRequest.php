<?php

namespace Modules\Company\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Modules\Company\Models\LegalCompanyInformation;
use Modules\Core\Rules\IranMobile;

class LegalCompanyStoreRequest extends FormRequest
{
	public function rules(): array
	{
		return [
			'company_name' => ['required', 'string', 'min:3', 'max:70'],
			'managment_mobile' => ['required', 'numeric', 'digits:11', 'unique:legal_company_information', new IranMobile()],
			'national_id' => ['required', 'numeric', 'digits:11', 'unique:legal_company_information'],
			'brand' => ['nullable', 'string', 'min:3', 'max:70'],
			'username' => ['required', 'alpha_num', 'unique:companies'],
			'password' => ['required', 'string', Password::min(6), 'confirmed'],
			'address' => ['required', 'min:3', 'max:1000'],
			'login_status' => ['required', 'boolean'],
			'workshop_code' => ['nullable', 'numeric'],
			'logo' => [
				'nullable', 
				'file', 
				'mimes:' . LegalCompanyInformation::ACCEPTED_IMAGE_MIMES,
				'size:' . LegalCompanyInformation::MAX_FILE_SIZE
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

	public function authorize(): bool
	{
		return true;
	}
}
