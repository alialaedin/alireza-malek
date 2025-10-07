<?php

namespace Modules\Contract\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Modules\Company\Enums\CompanyType;
use Modules\Company\Models\Company;
use Modules\Contract\Enums\ContractStatus;
use Modules\Contract\Http\Requests\Admin\ContractCompanyStoreRequest;
use Modules\Contract\Http\Requests\Admin\ContractCompanyUpdateRequest;
use Modules\Contract\Models\ContractCompany;

class ContractCompanyController extends Controller
{
  public function index()
  {
    $filters = ContractCompany::getFilterInputs();
    $contracts = ContractCompany::query()
      ->select(['id', 'company_id', 'contract_number', 'start_date', 'end_date', 'subject', 'status', 'created_at'])
      ->latest()
      ->filters()
      ->with('company:id,type')
      ->paginateWithQueryString();

    return view('contract::contract-company.index', compact(['contracts', 'filters']));
  }

  public function create(CompanyType $type)
  {
    $companies = Company::query()->select(['id', 'type'])->{$type->value}()->latest('id')->get();
    $statuses = ContractStatus::getCasesWithLabel();

    return view('contract::contract-company.create', compact(['companies', 'statuses']));
  }

  public function store(ContractCompanyStoreRequest $request)
  {
    $contract = ContractCompany::query()->create(Arr::except($request->validated(), 'file'));
    $contract->uploadFiles($request);

    return to_route('admin.contract-companies.index')->with('status', 'قرارداد با موفقیت ایجاد شد');
  }

  public function show(ContractCompany $contractCompany)
  {
    return view('contract::contract-company.show', compact('contractCompany'));
  }

  public function edit(ContractCompany $contractCompany)
  {
    $statuses = ContractStatus::getCasesWithLabel();

    return view('contract::contract-company.edit', compact(['statuses', 'contractCompany']));
  }

  public function update(ContractCompanyUpdateRequest $request, ContractCompany $contractCompany)
  {
    $contractCompany->update(Arr::except($request->validated(), ['file', 'company_id']));
    $contractCompany->uploadFiles($request);

    return to_route('admin.contract-companies.index')->with('status', 'قرارداد با موفقیت بروزرسانی شد');
  }

  public function destroy(ContractCompany $contractCompany)
  {
    $contractCompany->delete();

    return to_route('admin.contract-companies.index')->with('status', 'قرارداد با موفقیت حذف شد');
  }
}
