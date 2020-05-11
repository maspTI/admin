<?php

namespace App\Jobs;

use App\Subdepartment;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ChangeUserDepartment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $subdepartment;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Subdepartment $subdepartment)
    {
        $this->subdepartment = $subdepartment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $users = $this->subdepartment->users;

        $users->each(function ($user) {
            $user->update(['department_id' => $this->subdepartment->department_id]);
        });
    }
}
