<?php

namespace Modules\Company\Services;

use Illuminate\Http\Request;
use Modules\Company\Enums\CompanyType;
use Modules\Company\Models\Company;
use Modules\Company\Models\LegalCompanyInformation;
use Modules\Company\Models\RealCompanyInformation;

class CompanyInformationService
{
	public function store(Company $company, Request $request, CompanyType $type): void
	{
		$model = $this->getInformationModel($type);
		$fillable = $model->getFillable();

		$model->create(
			$request->only($fillable) + ['company_id' => $company->id]
		);
	}

	public function update(Company $company, Request $request, CompanyType $type): void
	{
		$model = $this->getInformationModel($type);
		$fillable = $model->getFillable();

		$model->where('company_id', $company->id)
			->update($request->only($fillable));
	}

	private function getInformationModel(CompanyType $type)
	{
		return match ($type) {
			CompanyType::LEGAL => new LegalCompanyInformation(),
			CompanyType::REAL  => new RealCompanyInformation(),
		};
	}
}
