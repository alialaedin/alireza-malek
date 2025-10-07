<?php

namespace Modules\Employee\Http\Requests\Registeration;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Core\Exceptions\ValidationException;

class AuthenticateEmploymentFormRequest extends FormRequest
{
    public function rules(): array
    {
      return [
        'mobile' => ['required', 'numeric', 'digits:11', 'starts_with:09', 'exists:employment_forms,mobile'],
        'sms_token' => ['required', 'numeric', 'digits:5'],
      ];
    }

  /**
   * @throws ValidationException
   */
  public function passedValidation(): void
  {
    $employmentForm = $this->route('employmentForm');
    $smsToken = $employmentForm->employmentFormToken;

    if (app()->isProduction()) {
      if (!$smsToken) {
        throw new ValidationException('کاربری با این مشخصات پیدا نشد!', 'sms_token');
      } elseif ($smsToken->token !== $this->input('sms_token')) {
        throw new ValidationException('کد وارد شده نادرست است!', 'sms_token');
      } elseif (Carbon::now()->gt($smsToken->expired_at)) {
        throw new ValidationException('کد وارد شده منقضی شده است!', 'sms_token');
      }
    }
  }

  public function authorize(): bool
    {
        return true;
    }
}
