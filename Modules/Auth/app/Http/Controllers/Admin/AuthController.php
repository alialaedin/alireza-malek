<?php

namespace Modules\Auth\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Auth\Enums\GuardName;
use Modules\Auth\Http\Requests\AdminLoginRequest;
use Modules\Auth\Services\AuthenticationService;

class AuthController extends Controller
{
	public function showLoginForm()
	{
		return view('auth::admin-login');
	}

	public function login(AdminLoginRequest $request): RedirectResponse
	{
		$authenticationService = new AuthenticationService($request, GuardName::ADMIN);
		$authenticationService->login();
		
		return redirect()->intended('/admin/dashboard');
	}

	public function logout(Request $request): RedirectResponse
	{
		$authenticationService = new AuthenticationService($request, GuardName::ADMIN);
		$authenticationService->logout();

		return redirect()->route('admin.login-form');
	}
}
