<?php

namespace Modules\Company\Http\Requests\Company\Workplace;

use Illuminate\Foundation\Http\FormRequest;

class WorkplaceStoreRequest extends FormRequest
{
	protected function prepareForValidation()
	{
		$this->merge([
			'status' => $this->boolean('status')
		]);
	}

	public function rules(): array
	{
		return [
			'title' => ['required', 'string', 'min:3', 'max:100'],
			'address' => ['required', 'string', 'min:3', 'max:2000'],
			'status' => ['required', 'boolean']
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
