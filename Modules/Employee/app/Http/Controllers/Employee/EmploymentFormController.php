<?php

namespace Modules\Employee\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Flasher\Toastr\Laravel\Facade\Toastr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Area\Models\City;
use Modules\Area\Models\Province;
use Modules\Employee\Enums\CarType;
use Modules\Employee\Enums\DriverLicenseType;
use Modules\Employee\Enums\LanguageSkillsStatus;
use Modules\Employee\Enums\MilitaryStatus;
use Modules\Employee\Enums\ResidenceStatus;
use Modules\Employee\Http\Requests\Registeration\AuthenticateEmploymentFormRequest;
use Modules\Employee\Http\Requests\Registeration\RegisterRequest;
use Modules\Employee\Http\Requests\Registeration\SendAuthenticationSmsRequest;
use Modules\Employee\Models\EmploymentForm;
use Modules\Employee\Services\EmploymentFormRegisterationService;
use Modules\Language\Models\Language;
use Modules\Relation\Models\Relation;

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
      (new EmploymentFormRegisterationService($employmentForm))->sendAuthenticationToken();

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
    (new EmploymentFormRegisterationService($employmentForm))->authenticate();

    Toastr::success('با موفقیت احراز هویت شدید. لطفا اطلاعات خود را کامل کنید');

    return to_route('employee.registration.show-register-form', $employmentForm);
  }

  public function showRegisterForm(EmploymentForm $employmentForm)
  {
    if (!$employmentForm->is_authenticated) {
      return redirect()->route('employee.registration.show-authentication-form', $employmentForm);
    }

    abort_if($employmentForm->is_filled, 404);

    (new EmploymentFormRegisterationService($employmentForm))->wasSeen();

    $carTypes = CarType::getCasesWithLabel();
    $driverLicenseTypes = DriverLicenseType::getCasesWithLabel();
    $languageSkillsStatuses = LanguageSkillsStatus::getCasesWithLabel();
    $militaryStatuses = MilitaryStatus::getCasesWithLabel();
    $residenceStatuses = ResidenceStatus::getCasesWithLabel();

    $provinces = Province::getAll();
    $cities = City::getAllActive();
    $languages = Language::getAll(true);
    $relations = Relation::getByCompanyId($employmentForm->company_id);

    return view('employee::registration.register-form', compact([
      'employmentForm',
      'carTypes',
      'driverLicenseTypes',
      'languageSkillsStatuses',
      'militaryStatuses',
      'residenceStatuses',
      'provinces',
      'cities',
      'languages',
      'relations'
    ]));
  }

  public function register(RegisterRequest $request, EmploymentForm $employmentForm)
  {
    try {
      DB::beginTransaction();

      $service = new EmploymentFormRegisterationService($employmentForm);
      $service->register($request);
      
      DB::commit();
    } catch (\Exception $exception) {

      DB::rollBack();
      Log::error($exception->getTraceAsString());

      return response()->error(
        'مشکلی در برنامه بوجود آمده است. لطفا با پشتیبانی تماس بگیرید: ' . $exception->getMessage(),
        $exception->getTrace(),
        422
      );
    }

    return response()->success('اطلاعات شما با موفقیت سمت شرکت ارسال شد');
  }
}
