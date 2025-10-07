<?php

namespace Modules\PriceList\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Core\Helpers\Helpers;

class PriceListUpdateRequest extends FormRequest
{
	private static array $amountableColumns;
	private static array $amountableColumnsRules;

	protected function prepareForValidation(): void
	{
		self::$amountableColumns = PriceListStoreRequest::$amountableColumns;
		self::$amountableColumnsRules = PriceListStoreRequest::$amountableColumnsRules;

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

	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		return true;
	}
}
