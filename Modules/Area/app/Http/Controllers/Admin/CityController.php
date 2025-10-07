<?php

namespace Modules\Area\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Area\Http\Requests\Admin\City\StoreRequest;
use Modules\Area\Http\Requests\Admin\City\UpdateRequest;
use Modules\Area\Models\City;
use Modules\Area\Models\Province;

class CityController extends Controller
{
	public function index()
	{
		$cities = City::query()->filters()->latest()->paginate()->withQueryString();
    $filters = City::getFilterInputs();

		return view('area::admin.city.index', compact(['cities', 'filters']));
	}

	public function create()
	{
		$provinces = Province::getAll();

		return view('area::admin.city.create', compact('provinces'));
	}

	public function store(StoreRequest $request)
	{
		City::create($request->validated());

		return to_route('admin.cities.index')->with('status', 'شهر با موفقیت ثبت شد.');
	}

	public function edit(City $city)
	{
		$provinces = Province::getAll();

		return view('area::admin.city.edit', compact(['city', 'provinces']));
	}

	public function update(UpdateRequest $request, City $city)
	{
		$city->update($request->validated());

		return to_route('admin.cities.index')->with('status', 'شهر با موفقیت ویرایش شد.');
	}

	public function destroy(City $city)
	{
		$city->delete();

		return to_route('admin.cities.index')->with('status', 'شهر با موفقیت حذف شد.');
	}
}
