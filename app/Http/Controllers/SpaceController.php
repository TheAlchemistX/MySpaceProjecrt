<?php

namespace App\Http\Controllers;

use App\Events\TaskCreated;
use App\Jobs\SendEmail;
use App\Models\SpaceJob;
use App\Models\task;
use Illuminate\Http\Request;
use App\Models\Space;
use Illuminate\Support\Facades\Auth;

class SpaceController extends Controller
{
    public function store()
    {
        $data = request()->validate([
            'name' => 'string',
            'description' => 'string',
        ]);
        $data['user_id'] = Auth::id();
        Space::create($data);
    }
    public function show()
    {
        $spaces = Space::where('user_id', Auth::id())->get();
    }

    public function update(Space $space){
        if($space->user_id==Auth::id()) {
            $data = request()->validate([
                'name' => 'string',
                'description' => 'string',
            ]);
            $data['user_id'] = Auth::id();
            $space->update($data);
        }
    }
    public function destroy(Space $space){
        if($space->user_id==Auth::id()) {
            /*$jobs = SpaceJob::where('space_id', $space->id);
            foreach ($jobs as $job){
                $task = task::where('job_id', $job->id);
                $task->delete();
            }
            $jobs->delete();*/
            $space->delete();
        }
    }
}
