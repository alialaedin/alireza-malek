<?php

namespace Modules\Employee\Services;

use Modules\Core\Exceptions\ValidationException;
use Modules\Employee\Enums\MilitaryStatus;
use Modules\Employee\Http\Requests\Registeration\RegisterRequest;

class ValidateEmployeeRegisteration
{
	public static function handle(RegisterRequest $request): void
	{
		if ($request->input('is_married') == 1 && $request->isNotFilled('spouse_job')) {
			throw new ValidationException('فیلد شغل همسر الزامی است');
		}

		if ($request->input('is_married') == 0 && $request->input('children_count') > 0) {
			if ($request->isNotFilled('custody_of_children')) {
				throw new ValidationException('فیلد حضانت فرزند الزامی است');
			}
			if (!$request->hasFile('custody_file')) {
				throw new ValidationException('فایل حضانت فرزند الزامی است');
			}
		}

		if (
			$request->input('military_status') === MilitaryStatus::EXEMPTED->value &&
			$request->isNotFilled('reason_for_exemption')
		) {
			throw new ValidationException('فیلد علت معافیت الزامی است');
		}

		if ($request->input('has_own_car') == 1) {
			if ($request->isNotFilled('car_type')) {
				throw new ValidationException('فیلد نوع اتومبیل الزامی است');
			}
		}

		if ($request->input('has_driver_license') == 1) {
			if ($request->isNotFilled('driver_license_type')) {
				throw new ValidationException('فیلد نوع گواهینامه الزامی است');
			}
			if ($request->isNotFilled('driver_license_number')) {
				throw new ValidationException('فیلد شماره گواهینامه الزامی است');
			}
		}

		if ($request->input('health_status') == 0 && $request->isNotFilled('disease')) {
			throw new ValidationException('فیلد بیماری الزامی است');
		}

		if ($request->input('has_surgery') == 1 && $request->isNotFilled('cause_of_surgery')) {
			throw new ValidationException('فیلد علت جراحی است');
		}

		if ($request->input('has_other_income') == 1) {
			if ($request->isNotFilled('other_income_source')) {
				throw new ValidationException('فیلد منبع درآمد الزامی است');
			}
			if ($request->isNotFilled('other_income_amount')) {
				throw new ValidationException('فیلد مبلغ درآمد الزامی است');
			}
		}
	}
}
