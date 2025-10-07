<?php

namespace Modules\Job\Http\Controllers\Company;

use Modules\Company\Http\Controllers\Company\BaseCompanyController;
use Modules\Job\Enums\DutyType;
use Modules\Job\Http\Requests\Company\DutyStoreRequest;
use Modules\Job\Http\Requests\Company\DutyUpdateRequest;
use Modules\Job\Models\Duty;

class DutyController extends BaseCompanyController
{
	public function index()
	{
		$filters = Duty::getFilterInputs();
		$duties = Duty::query()
			->select(['id', 'company_id', 'type', 'title', 'status', 'description', 'created_at'])
			->filters()
			->latest()
			->get();

		return view('job::company.duty.index', compact(['duties', 'filters']));
	}

	public function create()
	{
		$types = DutyType::getCasesWithLabel();

		return view('job::company.duty.create', compact('types'));
	}

	public function store(DutyStoreRequest $request)
	{
		Duty::create($request->validated());

		return to_route('company.duties.index')->with('status', 'وظیفه با موفقیت ایجاد شد');
	}

	public function edit(Duty $duty)
	{
		$types = DutyType::getCasesWithLabel();
		
		return view('job::company.duty.edit', compact(['duty', 'types']));
	}

	public function update(DutyUpdateRequest $request, Duty $duty)
	{
		$duty->update($request->validated());

		return to_route('company.duties.index')->with('status', 'وظیفه با موفقیت بروزرسانی شد');
	}

	public function destroy(Duty $duty)
	{
		$duty->delete();

		return to_route('company.duties.index')->with('status', 'وظیفه با موفقیت حذف شد');
	}
}
