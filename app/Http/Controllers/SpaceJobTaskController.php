<?php

namespace App\Http\Controllers;

use App\Events\TaskCreated;
use App\Jobs\SendEmail;
use App\Models\SpaceJob;
use App\Models\task;
use Illuminate\Http\Request;
use App\Models\Space;
use Illuminate\Support\Facades\Auth;

class SpaceJobTaskController extends Controller
{
    public function store(Request $request, Space $space, SpaceJob $job)
    {
        $this->authorize('view', $space);

        if($space->id == $job->space_id) {
            $data = request()->validate([
                'name' => 'string',
                'timer' => 'date',
            ]);
            $data['job_id'] = $job->id;
            task::create($data);

            $timer = abs(strtotime($data['timer']) - strtotime(date("Y-m-d H:i:s")));
            dispatch(new SendEmail($data))->delay(now()->addSecond($timer));
        }
    }
    public function show(Request $request, Space $space, SpaceJob $job)
    {
        if($space->id == $job->space_id) {
            $tasks = task::where('job_id', $job->id)->get();
        }
    }

    public function update(Request $request, Space $space, SpaceJob $job, task $task ){
        $this->authorize('view', $space);

        if($space->id == $job->space_id) {
            $data = request()->validate([
                'name' => 'string',
                'timer' => 'date',
            ]);
            $data['job_id'] = $job->id;
            $task->update($data);
            $timer = abs(strtotime($data['timer']) - strtotime(date("Y-m-d H:i:s")));

            dispatch(new SendEmail($data))->delay(now()->addSecond($timer));
        }
    }
    public function destroy(Request $request, Space $space, SpaceJob $job, task $task){
        $this->authorize('view', $space);
        if($space->id == $job->space_id) {
            $task->delete();
        }
    }
}
