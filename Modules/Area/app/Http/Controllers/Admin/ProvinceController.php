<?php

namespace Modules\Area\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Area\Http\Requests\Admin\Province\StoreRequest;
use Modules\Area\Http\Requests\Admin\Province\UpdateRequest;
use Modules\Area\Models\Province;

class ProvinceController extends Controller
{
  public function index()
  {
    $provinces = Province::query()->filters()->latest()->get();
    $filters = Province::getFilterInputs();

    return view('area::admin.province.index', compact(['provinces', 'filters']));
  }

  public function show(Province $province)
  {
    $province->load('cities');

    return view('area::admin.province.show', compact('province'));
  }

  public function create()
  {
    return view('area::admin.province.create');
  }

  public function store(StoreRequest $request)
  {
    Province::create($request->validated());

    return to_route('admin.provinces.index')->with('status', 'استان با موفقیت ثبت شد.');
  }

  public function edit(Province $province)
  {
    return view('area::admin.province.edit', compact('province'));
  }

  public function update(UpdateRequest $request, Province $province)
  {
    $province->update($request->validated());

    return to_route('admin.provinces.index')->with('status', 'استان با موفقیت ویرایش شد.');
  }

  public function destroy(Province $province)
  {
    $province->delete();

    return to_route('admin.provinces.index')->with('status', 'استان با موفقیت حذف شد.');
  }
}
