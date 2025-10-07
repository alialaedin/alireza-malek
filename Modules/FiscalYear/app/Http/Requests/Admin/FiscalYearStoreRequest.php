<?php

namespace Modules\FiscalYear\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FiscalYearStoreRequest extends FormRequest
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
			'year' => ['required', 'numeric', 'digits:4'],
			'status' => ['required', 'boolean']
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}
