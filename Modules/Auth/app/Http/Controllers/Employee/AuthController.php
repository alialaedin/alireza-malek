<?php

namespace Modules\Auth\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Auth\Enums\GuardName;
use Modules\Auth\Http\Requests\EMployeeLoginRequest;
use Modules\Auth\Services\AuthenticationService;

class AuthController extends Controller
{
	public function showLoginForm()
	{
		return view('auth::employee-login');
	}

	public function login(EMployeeLoginRequest $request): RedirectResponse
	{
		$authenticationService = new AuthenticationService($request, GuardName::EMPLOYEE);
		$authenticationService->login();

		return redirect()->intended('/employee/dashboard');
	}

	public function logout(Request $request): RedirectResponse
	{
		$authenticationService = new AuthenticationService($request, GuardName::EMPLOYEE);
		$authenticationService->logout();

		return redirect()->route('employee.login-form');
	}
}
