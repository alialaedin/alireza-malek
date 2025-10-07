<?php

namespace Modules\Employee\Listeners;

use Modules\Employee\Events\EmploymentFormAuthenticated;

class AuthenticateEmploymentForm
{
  public function handle(EmploymentFormAuthenticated $event): void
  {
    $event->employmentForm->update(['is_authenticated' => 1]);
    $event->employmentForm->employmentFormToken->update(['verified_at' => now()]);
  }
}
