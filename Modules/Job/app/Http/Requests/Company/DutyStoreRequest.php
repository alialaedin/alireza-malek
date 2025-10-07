<?php

namespace Modules\Job\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Job\Enums\DutyType;

class DutyStoreRequest extends FormRequest
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
			'type' => ['required', Rule::enum(DutyType::class)],
			'title' => ['required', 'string', 'min:3', 'max:100'],
			'description' => ['required', 'string', 'min:3', 'max:4000'],
			'status' => ['required', 'boolean']
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}
