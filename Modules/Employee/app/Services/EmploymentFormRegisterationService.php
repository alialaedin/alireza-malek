<?php

namespace Modules\Employee\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Modules\Core\Helpers\Helpers;
use Modules\Employee\Enums\EmploymentFormStatus;
use Modules\Employee\Http\Requests\Registeration\RegisterRequest;
use Modules\Employee\Models\Employee;
use Modules\Employee\Models\EmployeeProfile;
use Modules\Employee\Models\EmploymentForm;
use Modules\Sms\Sms;

class EmploymentFormRegisterationService
{
	public function __construct(private readonly EmploymentForm $employmentForm) {}

	public function sendAuthenticationToken(): array|Sms
	{
		$token = Helpers::randomNumbersCode(5);
		$output['status'] = 200;

		if (app()->isProduction()) {
			$output = Sms::pattern(config('sms-patterns.employee_authentication'))
				->data(['code' => $token])
				->to([$this->employmentForm->mobile])
				->send();
		}

		if ($output['status'] != 200) {
			Log::debug('', [$output]);
		}

		$this->employmentForm->employmentFormToken()->updateOrCreate(
			['employment_form_id' => $this->employmentForm->id],
			[
				'token' => $token,
				'expired_at' => Carbon::now()->addHours(24)
			]
		);

		return $output;
	}

	public function authenticate(): void
	{
		$this->employmentForm->update(['is_authenticated' => 1]);
		$this->employmentForm->employmentFormToken->update(['verified_at' => now()]);
	}

	public function wasSeen(): void
	{
		$this->employmentForm->has_seen = 1;
		$this->employmentForm->save();
	}

	public function register(RegisterRequest $registerRequest)
	{
		$employeeFillable = (new Employee())->getFillable();
		$employeeRequestInputs = $registerRequest->only($employeeFillable);
		$employee = Employee::query()->create($employeeRequestInputs);

		$employee->educationCertificates()->insert($registerRequest->input('education_certificates') ?? []);
		$employee->experiences()->insert($registerRequest->input('experiences') ?? []);
		$employee->languageSkills()->insert($registerRequest->input('language_skills') ?? []);
		$employee->referencePeople()->insert($registerRequest->input('reference_people') ?? []);

		$profileFillable = (new EmployeeProfile())->getFillable();
		$profileRequestInputs = $registerRequest->only($profileFillable);

		$employee->profile()->create($profileRequestInputs);

		$this->employmentForm->update([
			'is_filled' => 1,
			'status' => EmploymentFormStatus::AWAITING_REVIEW
		]);
	}
}
