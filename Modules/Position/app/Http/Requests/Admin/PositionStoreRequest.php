<?php

namespace Modules\Position\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PositionStoreRequest extends FormRequest
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
			'en_title' => ['required', 'min:3', 'max:50', 'unique:positions'],
			'title' => ['required', 'min:3', 'max:50'],
			'status' => ['required', 'boolean'],
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}
