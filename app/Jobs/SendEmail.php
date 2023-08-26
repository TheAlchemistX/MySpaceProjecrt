<?php

namespace App\Jobs;

use App\Events\TaskCreated;
use App\Mail\TimeOutSendMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $data;
    /**
     * Create a new spacejob instance.
     */
    public function __construct($data)
    {
        $this->data;
    }

    /**
     * Execute the spacejob.
     */
    public function handle(): void
    {
        Mail::to(auth()->user()->email)->send(new TimeOutSendMail());
    }
}
