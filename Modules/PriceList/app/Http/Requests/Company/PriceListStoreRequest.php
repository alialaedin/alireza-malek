<?php

namespace Modules\PriceList\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Core\Helpers\Helpers;

class PriceListStoreRequest extends FormRequest
{
	public static array $amountableColumns = [
		'salary',
		'right_to_housing_and_food',
		'worker_coupen_amount',
		'children_rights',
		'marriage_rights',
		'reward',
		'work_history_amount'
	];

	public static array $amountableColumnsRules = [
		'required',
		'integer',
		'min:0'
	];

	protected function prepareForValidation(): void
	{
		$newValues = [];
		$newValues['status'] = $this->boolean('status');

		foreach (self::$amountableColumns as $column) {
			$newValues[$column] = (int) Helpers::removeComma($this->input($column));
		}

		$this->merge($newValues);
	}

	public function rules(): array
	{
		$amountableColumnsRules = collect(self::$amountableColumns)
			->mapWithKeys(fn($column) => [
				$column => self::$amountableColumnsRules
			])->toArray();

		return [
			...$amountableColumnsRules,
			'fiscal_year_id' => ['required', 'integer', 'exists:fiscal_years,id'],
			'status' => ['required', 'boolean']
		];
	}

	public function authorize(): bool
	{
		return true;
	}
}
