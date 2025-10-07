<?php

namespace Modules\Company\Services;

use Illuminate\Http\Request;
use Modules\Company\Enums\CompanyType;
use Modules\Company\Repositories\CompanyRepository;

class CompanyService
{
	private readonly CompanyRepository $companyRepo;
	private readonly CompanyInformationService $infoService;
	private readonly SignatoryOwnerService $ownerService;
	private readonly LogoService $logoService;

	public function __construct(
		private readonly Request $request,
		private readonly CompanyType $type,
	) {
		$this->initializaServices();
	}

	private function initializaServices()
	{
		$this->companyRepo = new CompanyRepository();
		$this->infoService = new CompanyInformationService();
		$this->ownerService = new SignatoryOwnerService();
		$this->logoService = new LogoService();
	}

	public function store(): void
	{
		$company = $this->companyRepo->create($this->type, $this->request);

		$this->infoService->store($company, $this->request, $this->type);

		if ($this->type === CompanyType::LEGAL) {
			$this->ownerService->store($company, $this->request->input('signature_owners', []));
			$this->logoService->upload($company, $this->request);
		}
	}

	public function update(): void
	{
		$company = $this->companyRepo->resolveFromRoute($this->request, $this->type);

		$this->companyRepo->update($company, $this->request);
		$this->infoService->update($company, $this->request, $this->type);

		if ($this->type === CompanyType::LEGAL) {
			$this->ownerService->sync($company, $this->request->input('signature_owners', []));
			$this->logoService->sync($company, $this->request);
		}
	}
}
