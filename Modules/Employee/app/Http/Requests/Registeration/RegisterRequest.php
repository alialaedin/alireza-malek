<?php

namespace Modules\Employee\Http\Requests\Registeration;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Core\Rules\IranMobile;
use Modules\Employee\Enums\CarType;
use Modules\Employee\Enums\DriverLicenseType;
use Modules\Employee\Enums\LanguageSkillsStatus;
use Modules\Employee\Enums\MilitaryStatus;
use Modules\Employee\Enums\ResidenceStatus;
use Modules\Employee\Services\ValidateEmployeeRegisteration;

class RegisterRequest extends FormRequest
{
	protected function prepareForValidation()
	{
		$this->merge([
			'children_count' => $this->children_count ?? 0
		]);
	}

	public function rules(): array
	{
		return [
			'first_name' =>                  ['required', 'string', 'max:190'],
			'last_name' =>                   ['required', 'string', 'max:190'],
			'father_name' =>                 ['required', 'string', 'max:190'],
			'birth_place' =>                 ['required', 'string', 'max:190'],
			'nationality' =>                 ['required', 'string', 'max:190'],
			'religion' =>                    ['required', 'string', 'max:190'],
			'spouse_job' =>                  ['nullable', 'string', 'max:190'],
			'custody_of_children' =>         ['nullable', 'string', 'max:190'],
			'reason_for_exemption' =>        ['nullable', 'string', 'max:190'],
			'disease' =>                     ['nullable', 'string', 'max:190'],
			'cause_of_surgery' =>            ['nullable', 'string', 'max:190'],
			'other_income_source' =>         ['nullable', 'string', 'max:190'],
			'identity_card_number' =>        ['nullable', 'string', 'max:190'],
			'address' =>                     ['required', 'string', 'max:1000'],

			'is_married' =>                  ['required', 'boolean'],
			'has_driver_license' =>          ['required', 'boolean'],
			'has_own_car' =>                 ['required', 'boolean'],
			'has_other_income' =>            ['required', 'boolean'],
			'health_status' =>               ['required', 'boolean'],
			'has_surgery' =>                 ['required', 'boolean'],

			'children_count' =>              ['required', 'integer', 'min:0'],
			'other_income_amount' =>         ['nullable', 'integer', 'min:1000', 'max:1000000000'],
			'province_id' =>                 ['required', 'integer', 'exists:provinces,id'],
			'city_id' =>                     ['required', 'integer', 'exists:cities,id'],

			'identity_card_serial_number' => ['nullable', 'numeric'],
			'telephone' =>                   ['nullable', 'numeric'],
			'postal_code' =>                 ['required', 'numeric'],
			'driver_license_number' =>       ['nullable', 'numeric'],
			'national_code' =>               ['required', 'numeric', 'digits:10'],
			'mobile' =>                      ['required', ' numeric', 'digits:11', new IranMobile()],

			'birth_date' =>                  ['required', 'date'],
			'custody_file' =>                ['nullable', 'file'],

			'residence_status' =>            ['nullable', Rule::enum(ResidenceStatus::class)],
			'military_status' =>             ['required', Rule::enum(MilitaryStatus::class)],
			'car_type' =>                    ['nullable', Rule::enum(CarType::class)],
			'driver_license_type' =>         ['nullable', Rule::enum(DriverLicenseType::class)],

			'education_certificates'                             => ['nullable', 'array'],
			'education_certificates.*.degree'                    => ['required', 'string', 'max:190'],
			'education_certificates.*.field_of_study'            => ['required', 'string', 'max:190'],
			'education_certificates.*.university'                => ['required', 'string', 'max:190'],
			'education_certificates.*.place_of_obtaining_degree' => ['required', 'string', 'max:190'],
			'education_certificates.*.degree_obtained_at'        => ['required', 'date'],

			'experiences'                      => ['nullable', 'array'],
			'experiences.*.workplace'          => ['required', 'string', 'max:190'],
			'experiences.*.post'               => ['required', 'string', 'max:190'],
			'experiences.*.reason_for_leaving' => ['required', 'string', 'max:190'],
			'experiences.*.start_date'         => ['required', 'date'],
			'experiences.*.end_date'           => ['required', 'date'],
			'experiences.*.basic_salary'       => ['required', 'integer', 'min:1000', 'max:1000000000'],
			'experiences.*.last_salary'        => ['required', 'integer', 'min:1000', 'max:1000000000'],

			'language_skills'                => ['nullable', 'array'],
			'language_skills.*.language_id'  => ['required', 'integer', 'exists:languages,id'],
			'language_skills.*.conversation' => ['required', Rule::enum(LanguageSkillsStatus::class)],
			'language_skills.*.reading'      => ['required', Rule::enum(LanguageSkillsStatus::class)],
			'language_skills.*.writing'      => ['required', Rule::enum(LanguageSkillsStatus::class)],

			'reference_people'               => ['nullable', 'array'],
			'reference_people.*.relation_id' => ['required', 'integer', 'exists:relations,id'],
			'reference_people.*.first_name'  => ['required', 'string', 'max:190'],
			'reference_people.*.last_name'   => ['required', 'string', 'max:190'],
			'reference_people.*.job'         => ['required', 'string', 'max:190'],
			'reference_people.*.address'     => ['required', 'string', 'max:190'],
			'reference_people.*.mobile'      => ['required', ' numeric', 'digits:11', new IranMobile()],
		];
	}

	protected function passedValidation()
	{
		ValidateEmployeeRegisteration::handle($this);

		$this->merge([
			'password' => $this->mobile,
			'employment_form_id' => $this->route('employmentForm')->id,
			'can_login' => 0
		]);
	}

	public function authorize(): bool
	{
		return true;
	}
}
