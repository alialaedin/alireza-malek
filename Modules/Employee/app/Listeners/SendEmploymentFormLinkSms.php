<?php

namespace Modules\Employee\Listeners;

use Illuminate\Support\Facades\Log;
use Modules\Core\Helpers\Helpers;
use Modules\Employee\Events\EmploymentFormCreated;
use Modules\Sms\Sms;

class SendEmploymentFormLinkSms
{
	public function handle(EmploymentFormCreated $event): void
	{
		$employmentForm = $event->employmentForm;
		$link = route('employee.registration.show-authentication-form', $employmentForm);

		$output['status'] = 200;
		$pattern = config('sms-patterns.employee_registration');
		$data = ['link' => $link, 'fullName' => $employmentForm->full_name];
		$mobile = [$employmentForm->mobile];

		if (app()->isProduction()) {
			$output = Sms::pattern($pattern)->data($data)->to($mobile)->send();
		}

		if ($output['status'] != 200) {
			Log::debug('', [$output]);
		}
	}
}
