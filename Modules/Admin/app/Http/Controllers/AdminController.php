<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Modules\Admin\Http\Requests\AdminStoreRequest;
use Modules\Admin\Http\Requests\AdminUpdateRequest;
use Modules\Admin\Models\Admin;

class AdminController extends Controller
{
	public function index(): View
	{
		$admins = Admin::getAll();

		return view('admin::admin.index', compact('admins'));
	}

	public function show(Admin $admin): View
	{
		return view('admin::admin.show', compact('admin'));
	}

	public function create(): View
	{
		return view('admin::admin.create', compact('roles'));
	}

	public function store(AdminStoreRequest $request): RedirectResponse
	{
		Admin::create($request->validated());

		return redirect()->route('admin.admins.index')->with('status', 'ادمین با موفقیت ایجاد شد');
	}

	public function edit(Admin $admin): View
	{
		return view('admin::admin.edit', compact(['roles', 'admin']));
	}

	public function update(AdminUpdateRequest $request, Admin $admin): RedirectResponse
	{
		$admin->update($request->validated());

		return redirect()->route('admin.admins.index')->with('status', 'ادمین با موفقیت بروز شد');
	}

	public function destroy(Admin $admin): RedirectResponse
	{
		$admin->delete();

		return redirect()->route('admin.admins.index')->with('status', 'ادمین با موفقیت حذف شد');
	}
}
