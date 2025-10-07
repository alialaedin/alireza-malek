<?php

namespace Modules\Employee\Http\Requests\Registeration;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Core\Exceptions\ValidationException;
use Modules\Core\Rules\IranMobile;

class SendAuthenticationSmsRequest extends FormRequest
{
	public function rules(): array
	{
		return [
			'mobile' => ['required', 'digits:11', new IranMobile(), 'exists:employment_forms'],
		];
	}

	protected function passedValidation()
	{
		$employmentForm = $this->route('employmentForm');

		if ($this->mobile != $employmentForm->mobile) {
			throw new ValidationException('شماره همراه شما تایید نشده است');
		}
	}

	public function authorize(): bool
	{
		return true;
	}
}
