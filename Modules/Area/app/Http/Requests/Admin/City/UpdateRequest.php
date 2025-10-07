<?php

namespace Modules\Area\Http\Requests\Admin\City;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Core\Helpers\Helpers;

class UpdateRequest extends FormRequest
{
	public function rules()
	{
		$cityId = Helpers::getModelIdFromUrl('city');

		return  [
			'name' => ["required", "string", "unique:cities,id," . $cityId],
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
