<?php

namespace Modules\Accounting\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Modules\Accounting\Enums\HeadlineType;
use Modules\Accounting\Http\Requests\Admin\HeadlineStoreRequest;
use Modules\Accounting\Http\Requests\Admin\HeadlineUpdateRequest;
use Modules\Accounting\Models\Headline;

class HeadlineController extends Controller 
{
	public function index(): View
	{
		$headlines = Headline::getAll();

		return view('accounting::admin.headline.index', compact('headlines'));
	}

	public function create(): View
	{
		$types = HeadlineType::getCasesWithLabel();

		return view('accounting::admin.headline.create', compact('types'));
	}

	public function store(HeadlineStoreRequest $request): RedirectResponse
	{
		Headline::create($request->validated());

		return to_route('admin.headlines.index')->with('status', 'سرفصل با موفقیت ثبت شد');
	}

	public function edit(Headline $headline): View
	{
		$types = HeadlineType::getCasesWithLabel();

		return view('accounting::admin.headline.edit', compact(['headline', 'types']));
	}

	public function update(HeadlineUpdateRequest $request, Headline $headline): RedirectResponse
	{
		$headline->update($request->validated());

		return to_route('admin.headlines.index')->with('status', 'سرفصل با موفقیت بروز شد');
	}

	public function destroy(Headline $headline): RedirectResponse
	{
		$headline->delete();

		return to_route('admin.headlines.index')->with('status', 'سرفصل با موفقیت حذف شد');
	}
}
