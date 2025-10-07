<?php

namespace Modules\Profile\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Admin\Models\Admin;
use Modules\Auth\Enums\GuardName;
use Modules\Profile\Http\Requests\AdminProfileUpdateRequest;

class AdminProfileController extends Controller
{
	public function index()
	{
		return view('profile::admin-profile');
	}

	public function update(AdminProfileUpdateRequest $request)
	{
		/** @var Admin $admin */
		$admin = auth(GuardName::ADMIN->value)->user();
		$keys = ['username', 'name', 'mobile', 'email'];

		if ($request->filled('password')) {
			$keys['password'] = $request->input('password');
		}

		$admin->update($request->only($keys));

		return redirect()->back()->with('status', 'پروفایل با موفقیت بروزرسانی شد');
	}
}
