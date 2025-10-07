<?php

namespace Modules\Company\Http\Requests\Company\Workplace;

use Illuminate\Foundation\Http\FormRequest;

class WorkplaceUpdateRequest extends FormRequest
{
	protected function prepareForValidation()
	{
		$this->merge([
			'status' => $this->boolean('status')
		]);
	}

	public function rules(): array
	{
		return (new WorkplaceStoreRequest())->rules();
	}

	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		return true;
	}
}
