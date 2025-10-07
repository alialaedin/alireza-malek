<?php

namespace Modules\Company\Repositories;

use Illuminate\Http\Request;
use Modules\Company\Enums\CompanyType;
use Modules\Company\Enums\ContractStatus;
use Modules\Company\Models\Company;

class CompanyRepository
{
	public function create(CompanyType $type, Request $request): Company
	{
		return Company::create([
			'type'            => $type,
			'login_status'    => $request->input('login_status'),
			'username'        => $request->input('username'),
			'password'        => $request->input('password'),
			'contract_status' => ContractStatus::ON_HOLD,
		]);
	}

	public function resolveFromRoute(Request $request, CompanyType $type): Company
	{
		return match ($type) {
			CompanyType::LEGAL => $request->route('legal_company'),
			CompanyType::REAL  => $request->route('real_company'),
		};
	}

	public function update(Company $company, Request $request): void
	{
		$attributes = ['login_status', 'contract_status', 'username'];

		if ($request->filled('password')) {
			$attributes[] = 'password';
		}

		$company->update($request->only($attributes));
	}
}
