<?php

namespace Modules\Employee\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\Employee\Models\EmploymentForm;

class EmploymentFormCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public readonly EmploymentForm $employmentForm) {}

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
