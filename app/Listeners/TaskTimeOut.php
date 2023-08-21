<?php

namespace App\Listeners;

use App\Events\TaskCreated;
use App\Mail\TimeOutSendMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class TaskTimeOut implements ShouldQueue
{

    public function handle(TaskCreated $event): void
    {
        Mail::to('test@test.ru')->send(new TimeOutSendMail());
    }
}
