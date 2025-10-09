<?php

namespace Modules\Contract\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Modules\Campaign\Models\Campaign;
use Modules\Company\Enums\CompanyType;
use Modules\Company\Models\Company;
use Modules\Contract\Enums\ContractStatus;
use Modules\Contract\Http\Requests\Admin\ContractCompanyStoreRequest;
use Modules\Contract\Http\Requests\Admin\ContractCompanyUpdateRequest;
use Modules\Contract\Models\ContractCompany;
use Modules\Contract\Services\Admin\ContractService;

class ContractCompanyController extends Controller
{
  public function index()
  {
    $filters = ContractCompany::getFilterInputs();
    $contracts = ContractCompany::query()
      ->select(['id', 'company_id', 'campaign_id', 'contract_number', 'start_date', 'end_date', 'subject', 'status', 'created_at'])
      ->latest()
      ->filters()
      ->paginate()
      ->withQueryString();

    return view('contract::contract-company.index', compact(['contracts', 'filters']));
  }

  public function create(CompanyType $type)
  {
    $companies = Company::getAllCompanies()->filter(fn(array $c) => $c['type'] == $type->label());
    $statuses = ContractStatus::getCasesWithLabel();
    $campaigns = Campaign::getActiveCampaigns();

    return view('contract::contract-company.create', compact(['companies', 'statuses', 'campaigns']));
  }

  public function store(ContractCompanyStoreRequest $request)
  {
    ContractService::store($request);

    return to_route('admin.contract-companies.index')->with('status', 'قرارداد با موفقیت ایجاد شد');
  }

  public function show(ContractCompany $contractCompany)
  {
    $contractCompany->load('company', 'campaign');
    
    return view('contract::contract-company.show', compact('contractCompany'));
  }

  public function edit(ContractCompany $contractCompany)
  {
    $contractCompany->load('company:id,name,mobile');

    $statuses = ContractStatus::getCasesWithLabel();
    $campaigns = Campaign::getActiveCampaigns();

    return view('contract::contract-company.edit', compact(['statuses', 'contractCompany', 'campaigns']));
  }

  public function update(ContractCompanyUpdateRequest $request, ContractCompany $contractCompany)
  {
    ContractService::update($contractCompany, $request);

    return to_route('admin.contract-companies.index')->with('status', 'قرارداد با موفقیت بروزرسانی شد');
  }

  public function destroy(ContractCompany $contractCompany)
  {
    $contractCompany->delete();

    return to_route('admin.contract-companies.index')->with('status', 'قرارداد با موفقیت حذف شد');
  }
}
