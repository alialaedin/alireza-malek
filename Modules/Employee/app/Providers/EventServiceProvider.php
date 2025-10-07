<?php

namespace Modules\Employee\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Employee\Events\AttemptToAuthenticate;
use Modules\Employee\Events\EmploymentFormAuthenticated;
use Modules\Employee\Events\EmploymentFormCreated;
use Modules\Employee\Listeners\AuthenticateEmploymentForm;
use Modules\Employee\Listeners\SendEmploymentFormLinkSms;
use Modules\Employee\Listeners\SendEmploymentFormToken;

class EventServiceProvider extends ServiceProvider
{
	/**
	 * The event handler mappings for the application.
	 *
	 * @var array<string, array<int, string>>
	 */
	protected $listen = [
		EmploymentFormCreated::class => [SendEmploymentFormLinkSms::class],
		AttemptToAuthenticate::class => [SendEmploymentFormToken::class],
    EmploymentFormAuthenticated::class => [AuthenticateEmploymentForm::class],
	];

	/**
	 * Indicates if events should be discovered.
	 *
	 * @var bool
	 */
	protected static $shouldDiscoverEvents = true;

	/**
	 * Configure the proper event listeners for email verification.
	 */
	protected function configureEmailVerification(): void {}
}
