<?php

namespace Modules\Campaign\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Campaign\Enums\CampaignDiscountType;
use Modules\Core\Helpers\Helpers;

class CampaignStoreRequest extends FormRequest
{
	protected function prepareForValidation(): void
	{
		$this->merge([
			'discount_amount' => Helpers::removeComma($this->input('discount_amount')),
			'is_active' => $this->boolean('is_active')
		]);
	}

	public function rules(): array
	{
		return [
			'title' => ['required', 'string', 'unique:campaigns'],
			'usage_limit' => ['required', 'integer', 'min:1'],
			'start_date' => ['required', 'date', 'before_or_equal:end_date'],
			'end_date' => ['required', 'date', 'after_or_equal:start_date'],
			'discount_type' => ['required', Rule::enum(CampaignDiscountType::class)],
			'discount_amount' => ['required', 'numeric', 'min:1'],
			'description' => ['nullable', 'string', 'min:3'],
			'is_active' => ['required', 'boolean'],
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}
