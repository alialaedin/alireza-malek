<?php

namespace Modules\FiscalYear\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FiscalYearUpdateRequest extends FormRequest
{
	protected function prepareForValidation()
	{
		$this->merge([
			'status' => $this->boolean('status')
		]);
	}

	public function rules(): array
	{
		return (new FiscalYearStoreRequest())->rules();
	}

	public function authorize(): bool
	{
		return true;
	}
}
