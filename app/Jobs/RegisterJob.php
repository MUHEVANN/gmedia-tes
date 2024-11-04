<?php

namespace App\Jobs;

use App\Notifications\RegisterNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class RegisterJob implements ShouldQueue
{
    use Queueable;
    protected $user;
    /**
     * Create a new job instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->user->notify(new RegisterNotification());
    }
}
