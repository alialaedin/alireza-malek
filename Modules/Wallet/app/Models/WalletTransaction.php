<?php

namespace Modules\Wallet\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Arr;
use Modules\Auth\Enums\GuardName;
use Modules\Company\Models\Company;
use Modules\Core\Models\BaseModel;
use Modules\Core\Traits\Filterable;
use Modules\Wallet\Enums\WalletTransactionType;

class WalletTransaction extends BaseModel
{
	use Filterable;

	protected $fillable = ['wallet_id', 'type', 'amount', 'description'];
	protected $casts = ['type' => WalletTransactionType::class];
	protected static array $filterColumns = ['holder_id', 'holder_type', 'type', 'from_date', 'to_date'];

	public static function getFilterInputs(): array
	{
		$filters = Arr::only(config('core.filters'), self::$filterColumns);

		if (auth(GuardName::ADMIN->value)->check()) {
			$filters['holder_id']['options'] = Company::getAllCompanies()->pluck('title', 'id')->toArray();
			$filters['holder_id']['placeholder'] = 'شرکت را انتخاب کنید';
			$filters['holder_type']['value'] = 'Modules\Company\Models\Company';
		} else if (auth(GuardName::COMPANY->value)->check()) {
			// $filters['holder_id']['options'] = 
			$filters['holder_id']['placeholder'] = 'کارمند را انتخاب کنید';
			$filters['holder_type']['value'] = 'Modules\Employee\Models\Employee';
		}

		$filters['type']['options'] = collect(WalletTransactionType::getCasesWithLabel())->pluck('label', 'name')->toArray();
		$filters['type']['placeholder'] = 'نوع تراکنش را انتخاب کنید';
		
		return $filters;
	}

	public function wallet(): BelongsTo
	{
		return $this->belongsTo(Wallet::class);
	}
}
