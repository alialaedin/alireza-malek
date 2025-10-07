<?php

namespace Modules\PriceList\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Arr;
use Modules\Company\Traits\BelongsToCompany;
use Modules\Core\Models\BaseModel;
use Modules\Core\Traits\Filterable;
use Modules\FiscalYear\Models\FiscalYear;

class PriceList extends BaseModel
{
	use BelongsToCompany, Filterable;

	protected $fillable = [
		'company_id',
		'fiscal_year_id',
		'salary',
		'right_to_housing_and_food',
		'worker_coupen_amount',
		'children_rights',
		'marriage_rights',
		'reward',
		'work_history_amount',
		'status'
	];

	protected static array $filterColumns = [
		'fiscal_year_id',
		'status',
		'from_date',
		'to_date',
	];

	public static function getFilterInputs(): array
	{
		$filters = Arr::only(config('core.filters'), self::$filterColumns);
		$filters['fiscal_year_id']['options'] = FiscalYear::getAll(true)->pluck('year', 'id');

		return $filters;
	}

	public function fiscalYear(): BelongsTo
	{
		return $this->belongsTo(FiscalYear::class);
	}
}
