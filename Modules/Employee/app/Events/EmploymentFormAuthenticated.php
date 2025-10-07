<?php

namespace Modules\Employee\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\Employee\Models\EmploymentForm;

class EmploymentFormAuthenticated
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  /**
   * Create a new event instance.
   */
  public function __construct(public readonly EmploymentForm $employmentForm) {}

  /**
   * Get the channels the event should be broadcast on.
   */
  public function broadcastOn(): array
  {
    return [
      new PrivateChannel('channel-name'),
    ];
  }
}
