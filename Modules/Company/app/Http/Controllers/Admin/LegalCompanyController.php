<?php

namespace Modules\Company\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Company\Enums\CompanyType;
use Modules\Company\Enums\ContractStatus;
use Modules\Company\Http\Requests\Admin\LegalCompanyStoreRequest;
use Modules\Company\Http\Requests\Admin\LegalCompanyUpdateRequest;
use Modules\Company\Models\Company;
use Modules\Company\Services\CompanyService;
use Modules\Position\Models\Position;

class LegalCompanyController extends Controller
{
	public function index()
	{
		$legalCompanies = Company::query()->legal()->latest()->paginateWithQueryString();

		return view('company::admin.legal-companies.index', compact('legalCompanies'));
	}

	public function create()
	{
		$positions = Position::getAll();

		return view('company::admin.legal-companies.create', compact('positions'));
	}

	public function store(LegalCompanyStoreRequest $request)
	{
		(new CompanyService($request, CompanyType::LEGAL))->store();

		return response()->success('شرکت حقوقی با موفقیت ایجاد شد');
	}

	public function show(Company $legalCompany)
	{
		$legalCompany->load([
			'signatureOwners:id,company_id,full_name,mobile,father_name,national_code,position_id',
			'signatureOwners.position:id,title'
		]);

		return view('company::admin.legal-companies.show', compact('legalCompany'));
	}

	public function edit(Company $legalCompany)
	{
		$legalCompany->load('signatureOwners.position');
		$contractStatuses = ContractStatus::getCasesWithLabel();
		$positions = Position::getAll();

		return view('company::admin.legal-companies.edit', compact(['legalCompany', 'contractStatuses', 'positions']));
	}

	public function update(LegalCompanyUpdateRequest $request, Company $legalCompany)
	{
		(new CompanyService($request, $legalCompany->type))->update();

		return response()->success('شرکت حقوقی با موفقیت بروزرسانی شد');
	}

	public function destroy(Company $legalCompany)
	{
		$legalCompany->delete();

		return to_route('admin.legal-companies.index')->with('status', 'شرکت حقوقی با موفقیت حذف شد');
	}
}
