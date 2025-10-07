<?php

namespace Modules\Profile\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Profile\Http\Requests\CompanyProfileUpdateRequest;
use Modules\Profile\Services\CompanyProfileUpdaterService;

class CompanyProfileController extends Controller 
{
	public function index()
	{
		return view('profile::company-profile');
	}

	public function update(CompanyProfileUpdateRequest $request)
	{
		(new CompanyProfileUpdaterService($request))->update();

		return redirect()->back()->with('status', 'پروفایل با موفقیت بروزرسانی شد');
	}
}
