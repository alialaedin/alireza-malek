<?php

namespace Modules\Job\Http\Controllers\Company;

use Modules\Company\Http\Controllers\Company\BaseCompanyController;
use Modules\Job\Http\Requests\Company\CompanyJobStoreRequest;
use Modules\Job\Http\Requests\Company\CompanyJobUpdateRequest;
use Modules\Job\Models\CompanyJob;
use Modules\Job\Models\Duty;

class CompanyJobController extends BaseCompanyController
{
  public function index()
  {
    $companyJobs = CompanyJob::query()->select(['id', 'name', 'label', 'status', 'created_at'])->latest()->get();

    return view('job::company.job.index', compact('companyJobs'));
  }

  public function create()
  {
    $duties = Duty::query()->active()->private()->get();

    return view('job::company.job.create', compact('duties'));
  }

  public function store(CompanyJobStoreRequest $request)
  {
    CompanyJob::create($request->validated());

    return to_route('company.jobs.index')->with('status', 'شغل با موفقیت ایجاد شد');
  }

  public function edit(CompanyJob $job)
  {
    return view('job::company.job.edit', compact('job'));
  }

  public function update(CompanyJobUpdateRequest $request, CompanyJob $job)
  {
    $job->update($request->validated());

    return to_route('company.jobs.index')->with('status', 'شغل با موفقیت بروزرسانی شد');
  }

  public function show(CompanyJob $job)
  {
    $job->load('duties');

    return view('job::company.job.show', compact('job'));
  }

  public function destroy(CompanyJob $job)
  {
    $job->delete();

    return to_route('company.jobs.index')->with('status', 'شغل با موفقیت حذف شد');
  }
}
