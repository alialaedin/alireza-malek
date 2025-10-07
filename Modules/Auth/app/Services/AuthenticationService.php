<?php

namespace Modules\Auth\Services;

use Flasher\Toastr\Laravel\Facade\Toastr;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\Enums\GuardName;
use Modules\Core\Exceptions\ValidationException;

class AuthenticationService
{
  private User $user;

  public function __construct(
    private readonly Request $request,
    private readonly GuardName $guard
  ) {}

  /**
   * @throws ValidationException
   */
  public function login(): void
  {
    $this->setUser();
    $this->checkPassword();
    $this->loginUser();
  }

  public function logout(): void
  {
    Auth::guard($this->guard->value)->logout();

    $this->request->session()->invalidate();
    $this->request->session()->regenerateToken();
  }

  /**
   * @throws ValidationException
   */
  private function setUser(): void
  {
    $model = $this->guard->getModel();
    $requestUsername = $this->request->input('username');

    $user = $model::query()->where('username', $requestUsername)->first();

    if (!$user) {
      throw new ValidationException('نام کاربری یا رمز عبور نادرست است');
    }

    $this->user = $user;
  }

  /**
   * @throws ValidationException
   */
  private function checkPassword(): void
  {
    $requestPass = $this->request->input('password');

    if (!Hash::check($requestPass, $this->user->password)) {
      throw new ValidationException('نام کاربری یا رمز عبور نادرست است');
    }
  }

  /**
   * @throws ValidationException
   */
  private function loginUser(): void
  {
    $attempt = Auth::guard($this->guard->value)->attempt($this->request->validated());

    if (!$attempt) {
      throw new ValidationException('خطا در لاگین');
    }

    $this->request->session()->regenerate();
    Toastr::success('کاربر با موفقیت وارد پنل شد');
  }
}
