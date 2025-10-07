<?php

namespace Modules\PriceList\Http\Controllers\Company;

use Modules\Company\Http\Controllers\Company\BaseCompanyController;
use Modules\FiscalYear\Models\FiscalYear;
use Modules\PriceList\Http\Requests\Company\PriceListStoreRequest;
use Modules\PriceList\Http\Requests\Company\PriceListUpdateRequest;
use Modules\PriceList\Models\PriceList;

class PriceListController extends BaseCompanyController
{
	public function index()
	{
		$priceLists = PriceList::query()->latest()->filters()->get();
		$filters = PriceList::getFilterInputs();

		return view('pricelist::company.index', compact(['priceLists', 'filters']));
	}

	public function create()
	{
		$fiscalYears = FiscalYear::getAll(true);

		return view('pricelist::company.create', compact('fiscalYears'));
	}

	public function store(PriceListStoreRequest $request)
	{
		PriceList::create($request->validated());

		return to_route('company.price-lists.index')->with('status', 'نرخ نامه با موفقیت ایجاد شد');
	}

	public function edit(PriceList $priceList)
	{
		$fiscalYears = FiscalYear::getAll(true);

		return view('pricelist::company.edit', compact(['priceList', 'fiscalYears']));
	}

	public function update(PriceListUpdateRequest $request, PriceList $priceList)
	{
		$priceList->update($request->validated());

		return to_route('company.price-lists.index')->with('status', 'نرخ نامه با موفقیت بروزرسانی شد');
	}

	public function destroy(PriceList $priceList)
	{
		$priceList->delete();

		return to_route('company.price-lists.index')->with('status', 'نرخ نامه با موفقیت بروزرسانی شد');
	}
}
