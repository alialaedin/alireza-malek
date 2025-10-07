<?php

namespace Modules\Profile\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Modules\Auth\Enums\GuardName;
use Modules\Core\Rules\IranMobile;
use Modules\Profile\Services\PasswordUpdaterService;

class AdminProfileUpdateRequest extends FormRequest
{
	public function rules(): array
	{
		$adminId = auth(GuardName::ADMIN->value)->id();
		
		return [
			'name' => ['required', 'string', 'min:3', 'max:100'],
			'email' => ['required', 'string', 'email'],
			'mobile' => ['required', 'numeric', new IranMobile(), Rule::unique('admins')->ignore($adminId)],
			'username' => ['required', 'alpha_num', Rule::unique('admins')->ignore($adminId)],
			'current_password' => ['nullable', 'string'],
			'password' => ['nullable', 'string', Password::min(6), 'confirmed'],
		];
	}

	protected function passedValidation(): void
	{
		(new PasswordUpdaterService())->check($this, auth(GuardName::ADMIN->value)->user());
	}

	public function authorize(): bool
	{
		return true;
	}
}
