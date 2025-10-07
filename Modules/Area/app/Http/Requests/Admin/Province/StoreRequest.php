<?php

namespace Modules\Area\Http\Requests\Admin\Province;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
	public function rules()
	{
		return  [
			'name' => ["required", "string", "unique:provinces"],
			'status' => ["required", "boolean"],
		];
	}

	protected function prepareForValidation()
	{
		$this->merge([
			'status' => $this->boolean('status')
		]);
	}

	public function authorize(): bool
	{
		return true;
	}
}
