<?php

namespace Modules\Area\Http\Requests\Admin\City;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
	public function rules()
	{
		return  [
			'name' => ["required", "string", "unique:cities"],
			'province_id' => ["required", "exists:provinces,id"],
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
