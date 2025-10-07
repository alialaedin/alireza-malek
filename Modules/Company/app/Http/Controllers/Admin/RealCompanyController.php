<?php

namespace Modules\Company\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Company\Enums\ActivityLicense;
use Modules\Company\Enums\CompanyType;
use Modules\Company\Http\Requests\Admin\RealCompanyStoreRequest;
use Modules\Company\Http\Requests\Admin\RealCompanyUpdateRequest;
use Modules\Company\Models\Company;
use Modules\Company\Services\CompanyService;

class RealCompanyController extends Controller
{
	public function index()
	{
		$realCompanies = Company::query()->real()->latest()->paginateWithQueryString();

		return view('company::admin.real-companies.index', compact('realCompanies'));
	}

	public function create()
	{
		$activityLicenses = ActivityLicense::getCasesWithLabel();

		return view('company::admin.real-companies.create', compact('activityLicenses'));
	}

	public function store(RealCompanyStoreRequest $request)
	{
		(new CompanyService($request, CompanyType::REAL))->store();

		return to_route('admin.real-companies.index')->with('status', 'شرکت حقیقی با موفقیت ایجاد شد');
	}

	public function show(Company $realCompany)
	{
		return view('company::admin.real-companies.show', compact('realCompany'));
	}

	public function edit(Company $realCompany)
	{
		$activityLicenses = ActivityLicense::getCasesWithLabel();

		return view('company::admin.real-companies.edit', compact(['realCompany', 'activityLicenses']));
	}

	public function update(RealCompanyUpdateRequest $request, Company $realCompany)
	{
		(new CompanyService($request, $realCompany->type))->update();

		return to_route('admin.real-companies.index')->with('status', 'شرکت حقیقی با موفقیت بروزرسانی شد');
	}

	public function destroy(Company $realCompany)
	{
		$realCompany->delete();

		return to_route('admin.real-companies.index')->with('status', 'شرکت حقیقی با موفقیت حذف شد');
	}
}
