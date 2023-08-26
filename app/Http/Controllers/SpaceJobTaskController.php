<?php

namespace App\Http\Controllers;

use App\Events\TaskCreated;
use App\Http\Requests\SpaceJobTaskRequest;
use App\Jobs\SendEmail;
use App\Models\SpaceJob;
use App\Models\task;
use Illuminate\Http\Request;
use App\Models\Space;
use Illuminate\Support\Facades\Auth;

class SpaceJobTaskController extends Controller
{
    public function store(Request $request, Space $space, SpaceJob $job, SpaceJobTaskRequest $requests)
    {
        $this->authorize('view', $space);

        if($space->id == $job->space_id) {
            $data = $requests->validated();
            if(!empty($data)) {
                $data['job_id'] = $job->id;
                task::create($data);
                if (isset($data['timer'])) {
                    $timer = abs(strtotime($data['timer']) - strtotime(date("Y-m-d H:i:s")));
                    dispatch(new SendEmail($data))->delay(now()->addSecond($timer));
                }
                print_r($data);
            }else{
                print_r('Заполните данные');
            }
        }
    }
    public function show(Request $request, Space $space, SpaceJob $job)
    {
        if($space->id == $job->space_id) {
            $tasks = task::where('job_id', $job->id)->get();
            print_r($tasks);
        }
    }

    public function update(Request $request, Space $space, SpaceJob $job, task $task, SpaceJobTaskRequest $requests){
        $this->authorize('view', $space);

        if($space->id == $job->space_id) {
            $data = $requests->validated();
            $data['job_id'] = $job->id;
            $task->update($data);
            $timer = abs(strtotime($data['timer']) - strtotime(date("Y-m-d H:i:s")));

            dispatch(new SendEmail($data))->delay(now()->addSecond($timer));
            print_r($data);
        }
    }
    public function destroy(Request $request, Space $space, SpaceJob $job, task $task){
        $this->authorize('view', $space);
        if($space->id == $job->space_id) {
            $task->delete();
        }
    }
}
