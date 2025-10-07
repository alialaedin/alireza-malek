<?php

namespace Modules\Employee\Listeners;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Modules\Core\Helpers\Helpers;
use Modules\Employee\Events\AttemptToAuthenticate;
use Modules\Sms\Sms;

class SendEmploymentFormToken
{
  public function handle(AttemptToAuthenticate $event)
  {
    $token = Helpers::randomNumbersCode(5);
    $output['status'] = 200;

    if (app()->isProduction()) {
      $output = Sms::pattern(config('sms-patterns.employee_authentication'))
        ->data(['code' => $token])
        ->to([$event->requestMobile])
        ->send();
    }

    if ($output['status'] != 200) {
      Log::debug('', [$output]);
    }

    $event->employmentForm->employmentFormToken()->updateOrCreate(
      ['employment_form_id' => $event->employmentForm->id],
      [
        'token' => $token,
        'expired_at' => Carbon::now()->addHours(24)
      ]
    );

    return $output;
  }
}
