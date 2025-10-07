<?php

namespace Modules\Relation\Http\Controllers\Company;

use Modules\Company\Http\Controllers\Company\BaseCompanyController;
use Modules\Relation\Http\Requests\Company\RelationStoreRequest;
use Modules\Relation\Http\Requests\Company\RelationUpdateRequest;
use Modules\Relation\Models\Relation;

class RelationController extends BaseCompanyController
{
	public function index()
	{
		$relations = Relation::query()->latest()->get();

		return view('relation::company.index', compact('relations'));
	}

	public function create()
	{
		return view('relation::company.create');
	}

	public function store(RelationStoreRequest $request)
	{
		Relation::create($request->validated());

		return to_route('company.relations.index')->with('status', 'نسبت خانوادگی با موفقیت ایجاد شد');
	}

	public function edit(Relation $relation)
	{
		return view('relation::company.edit', compact('relation'));
	}

	public function update(RelationUpdateRequest $request, Relation $relation)
	{
		$relation->update($request->validated());

		return to_route('company.relations.index')->with('status', 'نسبت خانوادگی با موفقیت بروزرسانی شد');
	}

	public function destroy(Relation $relation)
	{
		$relation->delete();

		return to_route('company.relations.index')->with('status', 'نسبت خانوادگی با موفقیت حذف شد');
	}
}
