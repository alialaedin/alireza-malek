<?php

namespace Modules\Relation\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Company\Traits\BelongsToCompany;
use Modules\Core\Models\BaseModel;
use Modules\Employee\Models\ReferencePerson;

class Relation extends BaseModel
{
	use BelongsToCompany;

	protected $fillable = ['company_id', 'name', 'status'];

	public static function getByCompanyId(int $companyId): Collection
	{
		return self::query()
			->where('company_id', $companyId)
			->where('status', 1)
			->get();
	}

	public function referencePeople(): HasMany
	{
		return $this->hasMany(ReferencePerson::class);
	}
}
