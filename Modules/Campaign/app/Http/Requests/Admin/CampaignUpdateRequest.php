<?php

namespace Modules\Campaign\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Core\Helpers\Helpers;

class CampaignUpdateRequest extends FormRequest
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
		$rules = (new CampaignStoreRequest())->rules();
		$id = Helpers::getModelIdFromUrl('campaign');

		return [
			...$rules,
			'title' => ['required', 'string', Rule::unique('campaigns')->ignore($id)],
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}
