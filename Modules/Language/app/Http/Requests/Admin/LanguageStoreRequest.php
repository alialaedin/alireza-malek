<?php

namespace Modules\Language\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LanguageStoreRequest extends FormRequest
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
			'persian_name' => ['required', 'string', 'min:3', 'max:100'],
			'english_name' => ['required', 'string', 'min:3', 'max:100', 'unique:languages'],
			'code' => ['required', 'string', 'min:1', 'max:10', 'unique:languages'],
			'native_name' => ['required', 'string', 'alpha', 'min:3', 'max:100', 'unique:languages'],
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
