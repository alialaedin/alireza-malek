<?php

namespace Modules\Position\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PositionUpdateRequest extends FormRequest
{
	protected function prepareForValidation()
	{
		$this->merge([
			'status' => $this->boolean('status')
		]);
	}

	public function rules(): array
	{
		$position = $this->route('position');

		return array_merge((new PositionStoreRequest)->rules(), [
			'en_title' => ['required', 'min:3', 'max:50', Rule::unique('positions')->ignoreModel($position)],
		]);
	}
	public function authorize(): bool
	{
		return true;
	}
}
