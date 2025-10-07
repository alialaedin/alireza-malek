<?php

namespace Modules\Profile\Services;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Modules\Core\Exceptions\ValidationException;

class PasswordUpdaterService
{
  public function check(Request $request, Authenticatable $user)
  {
    if (
      $request->filled('current_password') &&
      !Hash::check($request->input('current_password'), $user->password)
    ) {
      throw new ValidationException('رمز عبور فعلی نادرست است');
    }

    if (
      $request->filled('password') &&
      $request->isNotFilled('current_password')
    ) {
      throw new ValidationException('رمز عبور فعلی وارد نشده است');
    }
  }
}
