<?php

namespace Modules\Area\Http\Requests\Admin\Province;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Core\Helpers\Helpers;

class UpdateRequest extends FormRequest
{
	public function rules()
	{
		$provinceId = Helpers::getModelIdFromUrl('province');

		return  [
			'name' => ["required", "string", "unique:provinces,id," . $provinceId],
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
