<?php

namespace Modules\Language\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Core\Helpers\Helpers;

class LanguageUpdateRequest extends FormRequest
{
	protected function prepareForValidation()
	{
		$this->merge([
			'status' => $this->boolean('status')
		]);
	}

	public function rules(): array
	{
		$id = Helpers::getModelIdFromUrl('language');
		$rules = (new LanguageStoreRequest())->rules();

		return [
			...$rules,
			'english_name' => ['required', 'string', 'min:3', 'max:100', Rule::unique('languages')->ignore($id)],
			'code' => ['required', 'string', 'min:1', 'max:10', Rule::unique('languages')->ignore($id)],
			'native_name' => ['required', 'string', 'alpha', 'min:3', 'max:100', Rule::unique('languages')->ignore($id)],
		];
	}
	public function authorize(): bool
	{
		return true;
	}
}
