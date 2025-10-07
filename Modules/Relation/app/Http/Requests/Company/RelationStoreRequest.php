<?php

namespace Modules\Relation\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class RelationStoreRequest extends FormRequest
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
			'name' => ['required', 'string', 'min:3', 'max:100'],
			'status' => ['required', 'boolean']
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}
