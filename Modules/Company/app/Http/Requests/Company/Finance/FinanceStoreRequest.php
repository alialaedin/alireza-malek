<?php

namespace Modules\Company\Http\Requests\Company\Finance;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Modules\Auth\Enums\GuardName;

class FinanceStoreRequest extends FormRequest
{
	protected function prepareForValidation()
	{
		if ($this->filled('finances')) {
			$companyId = Auth::guard(GuardName::COMPANY->value)->id();
			$finances = collect($this->input('finances'))->map(function ($i) use ($companyId) {
				return [
					...$i,
					'status' => isset($i['status']) ? 1 : 0,
					'company_id' => $companyId
				];
			})->toArray();
			
			$this->merge([
				'finances' => $finances,
			]);
		}
	}

	public function rules(): array
	{
		return [
			'finances'        => ['required', 'array'],
			'finances.*.name' => ['required', 'string', 'min:3'],
			'finances.*.code' => [
				'required',
				'numeric',
				Rule::unique('finances', 'code')
					->where('company_id', Auth::guard(GuardName::COMPANY->value)->id())
			],
			'finances.*.status' => ['required', 'boolean'],
		];
	}

	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		return true;
	}
}
