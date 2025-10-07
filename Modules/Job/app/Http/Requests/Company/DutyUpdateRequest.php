<?php

namespace Modules\Job\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class DutyUpdateRequest extends FormRequest
{
	protected function prepareForValidation()
	{
		$this->merge([
			'status' => $this->boolean('status')
		]);
	}
	public function rules(): array
	{
		return (new DutyStoreRequest())->rules();
	}

	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		return true;
	}
}
