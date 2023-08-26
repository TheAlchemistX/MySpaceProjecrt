<?php

namespace App\Http\Controllers;

use App\Events\TaskCreated;
use App\Http\Requests\SpaceJobRequest;
use App\Jobs\SendEmail;
use App\Models\SpaceJob;
use App\Models\task;
use Illuminate\Http\Request;
use App\Models\Space;
use Illuminate\Support\Facades\Auth;

class SpaceJobController extends Controller
{
    public function store(Space $space, SpaceJobRequest $request)
    {
        $this->authorize('view', $space);
        $data = $request->validated();
        if(!empty($data)) {
            $data['date_create'] = date("Y-m-d H:i:s");
            $data['space_id'] = $space->id;
            SpaceJob::create($data);
            print_r($data);
        }else{
            print_r('Заполните данные');
        }
    }
    public function show(Space $space)
    {
        $this->authorize('view', $space);
        $jobs = SpaceJob::where('space_id', $space->id)->get();
        print_r($jobs);
    }

    public function update(Request $request, Space $space, SpaceJob $job, SpaceJobRequest $requests){

        $this->authorize('view', $space);
        $data = $requests->validated();
        $data['date_create'] = date("Y-m-d H:i:s");
        $data['space_id'] = $space->id;
        $job->update($data);
        print_r($data);
    }
    public function destroy(Request $request, Space $space, SpaceJob $job){
        $this->authorize('view', $space);
        $job->delete();
    }
}
