<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\UserEmail;
use Mail;

class UserEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $u_info;

    public function __construct($u_info)
    {
        $this->u_info = $u_info;
    
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new UserEmail($this->u_info);
        Mail::to($this->u_info->email)->send($email);
    }
}
