<?php

namespace Modules\Company\Http\Controllers\Company;

use Modules\Company\Http\Requests\Company\Workplace\WorkplaceStoreRequest;
use Modules\Company\Http\Requests\Company\Workplace\WorkplaceUpdateRequest;
use Modules\Company\Models\Workplace;

class WorkplaceController extends BaseCompanyController
{
	public function index()
	{
		$workplaces = Workplace::query()->latest()->get();

		return view('company::company.workplace.index', compact('workplaces'));
	}

	public function create()
	{
		return view('company::company.workplace.create');
	}

	public function store(WorkplaceStoreRequest $request)
	{
		Workplace::create($request->validated());

		return to_route('company.workplaces.index')->with('status', 'محل کار با موفقیت ایجاد شد');
	}

	public function edit(Workplace $workplace)
	{
		return view('company::company.workplace.edit', compact('workplace'));
	}

	public function update(WorkplaceUpdateRequest $request, Workplace $workplace)
	{
		$workplace->update($request->validated());

		return to_route('company.workplaces.index')->with('status', 'محل کار با موفقیت بروزرسانی شد');
	}

	public function destroy(Workplace $workplace)
	{
		$workplace->delete();

		return to_route('company.workplaces.index')->with('status', 'محل کار با موفقیت حذف شد');
	}
}
