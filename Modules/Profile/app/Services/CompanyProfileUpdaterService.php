<?php

namespace Modules\Profile\Services;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Modules\Auth\Enums\GuardName;
use Modules\Company\Enums\CompanyType;
use Modules\Company\Models\LegalCompanyInformation;
use Modules\Company\Models\RealCompanyInformation;
use Modules\Company\Services\LogoService;
use Modules\Core\Exceptions\ValidationException;
use Modules\Core\Rules\IranMobile;

class CompanyProfileUpdaterService
{
	private Authenticatable $company;
	private Request $request;
	private LogoService $logoService;

	public function __construct(Request $request)
	{
		$this->request = $request;
		$this->company = auth(GuardName::COMPANY->value)->user();
		$this->logoService = new LogoService();
	}

	public function update(): void
	{
		$this->updateCompany();
		$this->updateInformation();
	}

	private function updateCompany(): void
	{
		$attrs = ['username' => $this->request->input('username')];

		if ($this->request->filled('password')) {
			$attrs['password'] = $this->request->input('password');
		}

		$this->company->update($attrs);
	}

	private function updateInformation(): void
	{
		$info = $this->getCompanyInformationModel();
		$fillables = $this->getFillablesByCompanyType();

		if ($this->company->type === CompanyType::LEGAL) {
			$this->logoService->sync($info->company, $this->request);
		}

		$info->fill($this->request->only($fillables));
		$info->save();
	}

	private function getCompanyInformationModel(): LegalCompanyInformation|RealCompanyInformation
	{
		return match ($this->company->type) {
			CompanyType::REAL => RealCompanyInformation::findByCompanyIdOrFail($this->company->id),
			CompanyType::LEGAL => LegalCompanyInformation::findByCompanyIdOrFail($this->company->id),
		};
	}

	private function getFillablesByCompanyType(): array
	{
		return match ($this->company->type) {
			CompanyType::REAL => ['full_name', 'father_name', 'address', 'national_code', 'mobile'],
			CompanyType::LEGAL => ['company_name', 'brand', 'address', 'workshop_code', 'managment_mobile', 'national_id'],
		};
	}

	public function getRules(): array
	{
		return match ($this->company->type) {
			CompanyType::REAL => $this->realCompanyRules(),
			CompanyType::LEGAL => $this->legalCompanyRules(),
		};
	}

	private function legalCompanyRules(): array
	{
		return array_merge(
			[
				'company_name' => ['required', 'string', 'min:3', 'max:70'],
				'brand' => ['nullable', 'string', 'min:3', 'max:70'],
				'address' => ['required', 'min:3', 'max:1000'],
				'workshop_code' => ['nullable', 'numeric'],
				'managment_mobile' => [
					'required',
					'numeric',
					'digits:11',
					new IranMobile(),
					Rule::unique('legal_company_information')->ignore($this->company->id, 'company_id')
				],
				'national_id' => [
					'required',
					'numeric',
					'digits:11',
					Rule::unique('legal_company_information')->ignore($this->company->id, 'company_id')
				],
				'logo' => ['nullable', 'file', 'mimes:' . LegalCompanyInformation::ACCEPTED_IMAGE_MIMES, 'max:' . LegalCompanyInformation::MAX_FILE_SIZE / 1024],
			],
			$this->baseCompanyRules()
		);
	}

	private function realCompanyRules(): array
	{
		return array_merge(
			[
				'full_name' => ['required', 'min:3', 'max:100'],
				'father_name' => ['required', 'min:3', 'max:100'],
				'address' => ['required', 'min:3', 'max:1000'],
				'national_code' => [
					'required',
					'numeric',
					'digits:10',
					Rule::unique('real_company_information')->ignore($this->company->id, 'company_id')
				],
				'mobile' => [
					'required',
					'numeric',
					new IranMobile(),
					Rule::unique('real_company_information')->ignore($this->company->id, 'company_id')
				],
			],
			$this->baseCompanyRules()
		);
	}

	private function baseCompanyRules(): array
	{
		return [
			'username' => ['required', 'alpha_num', Rule::unique('companies')->ignore($this->company->id)],
			'current_password' => ['nullable', 'string'],
			'password' => ['nullable', 'string', Password::min(6), 'confirmed'],
		];
	}
}
