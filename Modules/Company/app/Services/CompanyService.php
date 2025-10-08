<?php

namespace Modules\Company\Services;

use Illuminate\Http\Request;
use Modules\Company\Models\Company;

class CompanyService
{
	private readonly SignatoryOwnerService $ownerService;
	private readonly LogoService $logoService;

	public function __construct(private readonly Request $request)
	{
		$this->ownerService = new SignatoryOwnerService();
		$this->logoService = new LogoService();
	}

	public function store(): void
	{
		$keys = (new Company())->getFillable();
		$company = Company::create($this->request->only($keys));

		$this->logoService->upload($company, $this->request);
		$this->ownerService->store($company, $this->request->input('signature_owners', default: []));
	}

	public function update(): void
	{
		$keys = (new Company())->getFillable();
		if ($this->request->isNotFilled('password')) {
			unset($keys['password']);
		}

		$company = $this->request->route('company');
		$company->update($this->request->only($keys));

		$this->ownerService->sync($company, $this->request->input('signature_owners', []));
		$this->logoService->sync($company, $this->request);
	}
}
