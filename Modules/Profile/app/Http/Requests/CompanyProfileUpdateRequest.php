<?php

namespace Modules\Profile\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Auth\Enums\GuardName;
use Modules\Profile\Services\CompanyProfileUpdaterService;
use Modules\Profile\Services\PasswordUpdaterService;

class CompanyProfileUpdateRequest extends FormRequest
{
	public function rules(): array
	{
		return (new CompanyProfileUpdaterService($this))->getRules();
	}

	protected function passedValidation(): void
	{
		(new PasswordUpdaterService())->check($this, auth(GuardName::COMPANY->value)->user());
	}

	public function authorize(): bool
	{
		return true;
	}
}
