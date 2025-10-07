<?php

namespace Modules\Company\Services;

use Illuminate\Support\Arr;
use Modules\Company\Models\Company;

class SignatoryOwnerService
{
	public function store(Company $company, array $owners): void
	{
		foreach ($owners as $owner) {
			$company->signatureOwners()->create($owner);
		}
	}

	public function sync(Company $company, array $owners): void
	{
		$owners = collect($owners);

		$existingOwners = $owners->filter(fn($owner) => !empty($owner['id']));
		$newOwners = $owners->filter(fn($owner) => empty($owner['id']));

		$existingIds = $existingOwners->pluck('id')->toArray();

		$company->signatureOwners()
			->whereNotIn('id', $existingIds)
			->delete();

		$existingOwners->each(function ($owner) use ($company) {
			$company->signatureOwners()
				->where('id', $owner['id'])
				->update(Arr::except($owner, ['id']));
		});

		$newOwners->each(function ($owner) use ($company) {
			$company->signatureOwners()->create(
				Arr::except($owner, ['id'])
			);
		});
	}
}
