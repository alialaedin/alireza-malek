<?php

namespace Modules\Employee\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Flasher\Toastr\Laravel\Facade\Toastr;
use Illuminate\Support\Facades\Log;
use Modules\Employee\Enums\CarType;
use Modules\Employee\Enums\DriverLicenseType;
use Modules\Employee\Enums\EmploymentFormStatus;
use Modules\Employee\Enums\LanguageSkillsStatus;
use Modules\Employee\Enums\MilitaryStatus;
use Modules\Employee\Enums\ResidenceStatus;
use Modules\Employee\Http\Requests\Registeration\AuthenticateEmploymentFormRequest;
use Modules\Employee\Http\Requests\Registeration\SendAuthenticationSmsRequest;
use Modules\Employee\Models\EmploymentForm;
use Modules\Employee\Services\EmploymentFormRegisterationService;

class EmploymentFormController extends Controller
{
  public function showAuthenticationForm(EmploymentForm $employmentForm)
  {
    if ($employmentForm->is_authenticated) {
      return to_route('employee.registration.show-register-form', $employmentForm);
    }

    return view('employee::registration.authentication-form', compact('employmentForm'));
  }

  public function sendAuthenticationToken(SendAuthenticationSmsRequest $request, EmploymentForm $employmentForm)
  {
    try {

      $service = new EmploymentFormRegisterationService($employmentForm);
      $service->sendAuthenticationToken();

      Toastr::success('کد ورود با موفقیت ارسال شد');
    } catch (\Exception $exception) {

      Log::error($exception->getTraceAsString());

      return response()->error(
        'مشکلی در برنامه بوجود آمده است. لطفا با پشتیبانی تماس بگیرید: ' . $exception->getMessage(),
        $exception->getTrace(),
        422
      );
    }

    return response()->success('کد ورود برای شما ارسال شد');
  }

  public function authenticate(AuthenticateEmploymentFormRequest $request, EmploymentForm $employmentForm)
  {
    $service = new EmploymentFormRegisterationService($employmentForm);
    $service->authenticate();

    Toastr::success('با موفقیت احراز هویت شدید. لطفا اطلاعات خود را کامل کنید');

    return to_route('employee.registration.show-register-form', $employmentForm);
  }

  public function showRegisterForm(EmploymentForm $employmentForm)
  {
    if (!$employmentForm->is_authenticated) {
      return redirect()->route('employee.registration.show-authentication-form', $employmentForm);
    }

    abort_if($employmentForm->is_filled, 404);

    $service = new EmploymentFormRegisterationService($employmentForm);
    $service->wasSeen();

    $carTypes = CarType::getCasesWithLabel();
    $driverLicenseTypes = DriverLicenseType::getCasesWithLabel();
    $languageSkillsStatuses = LanguageSkillsStatus::getCasesWithLabel();
    $militaryStatuses = MilitaryStatus::getCasesWithLabel();
    $residenceStatuses = ResidenceStatus::getCasesWithLabel();

    return view('employee::registration.register-form', compact([
      'employmentForm',
      'carTypes',
      'driverLicenseTypes',
      'languageSkillsStatuses',
      'militaryStatuses',
      'residenceStatuses'
    ]));
  }
}
