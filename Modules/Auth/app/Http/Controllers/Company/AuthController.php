<?php

namespace Modules\Auth\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Auth\Enums\GuardName;
use Modules\Auth\Http\Requests\CompanyLoginRequest;
use Modules\Auth\Services\AuthenticationService;
use Modules\Core\Exceptions\ValidationException;

class AuthController extends Controller
{
	public function showLoginForm()
	{
		return view('auth::company-login');
	}

  /**
   * @throws ValidationException
   */
  public function login(CompanyLoginRequest $request): RedirectResponse
	{
		$authenticationService = new AuthenticationService($request, GuardName::COMPANY);
		$authenticationService->login();

		return redirect()->intended('/company/dashboard');
	}

	public function logout(Request $request): RedirectResponse
	{
		$authenticationService = new AuthenticationService($request, GuardName::COMPANY);
		$authenticationService->logout();

		return redirect()->route('company.login-form');
	}
}
