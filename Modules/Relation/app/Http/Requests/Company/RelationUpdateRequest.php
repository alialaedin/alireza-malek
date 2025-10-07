<?php

namespace Modules\Relation\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class RelationUpdateRequest extends FormRequest
{
	protected function prepareForValidation()
	{
		$this->merge([
			'status' => $this->boolean('status')
		]);
	}

	public function rules(): array
	{
		return (new RelationStoreRequest())->rules();
	}

	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		return true;
	}
}
