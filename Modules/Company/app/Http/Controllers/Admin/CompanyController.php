<?php

namespace Modules\Company\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Company\Enums\ActivityLicense;
use Modules\Company\Enums\CompanyType;
use Modules\Company\Http\Requests\Admin\CompanyStoreRequest;
use Modules\Company\Http\Requests\Admin\CompanyUpdateRequest;
use Modules\Company\Models\Company;
use Modules\Company\Services\CompanyService;
use Modules\Position\Models\Position;

class CompanyController extends Controller
{
	public function index()
	{
		$filters = Company::getFilterInputs();
		$companies = Company::query()
			->select(['id', 'name', 'mobile', 'username', 'login_status', 'type', 'created_at'])
			->latest()
			->paginate()
			->withQueryString();

		return view('company::admin.company.index', compact(['companies', 'filters']));
	}

	public function create()
	{
		$activityLicenses = ActivityLicense::getCasesWithLabel();
		$positions = Position::getAll();
		$types = CompanyType::getCasesWithLabel();

		return view('company::admin.company.create', compact(['activityLicenses', 'positions', 'types']));
	}

	public function store(CompanyStoreRequest $request)
	{
		DB::transaction(fn() => (new CompanyService($request))->store());

		return response()->success('شرکت با موفقیت ایجاد شد');
	}

	public function edit(Company $company)
	{
		$company->load('signatureOwners.position');

		$activityLicenses = ActivityLicense::getCasesWithLabel();
		$positions = Position::getAll();
		$types = CompanyType::getCasesWithLabel();

		return view('company::admin.company.edit', compact(['activityLicenses', 'positions', 'types', 'company']));
	}

	public function update(CompanyUpdateRequest $request, Company $company)
	{
		DB::transaction(fn() => (new CompanyService($request))->update());

		return response()->success('شرکت با موفقیت بروزرسانی شد');
	}
}
