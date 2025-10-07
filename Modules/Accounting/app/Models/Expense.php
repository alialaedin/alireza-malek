<?php

namespace Modules\Accounting\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Arr;
use Modules\Accounting\Enums\HeadlineType;
use Modules\Core\Models\BaseModel;
use Modules\Core\Traits\Filterable;

class Expense extends BaseModel
{
	use Filterable;

	protected $fillable = ['headline_id', 'title', 'amount', 'payment_date', 'description'];
	protected $with = ['headline'];
	protected static array $filterColumns = ['headline_id', 'title', 'from_date', 'to_date'];

	public static function getFilterInputs(): array
	{
		$filters = Arr::only(config('core.filters'), self::$filterColumns);
		$filters['headline_id']['options'] = Headline::getAllByType(HeadlineType::EXPENSE);
		
		return $filters;
	}

	public function headline(): BelongsTo
	{
		return $this->belongsTo(Headline::class);
	}
}
