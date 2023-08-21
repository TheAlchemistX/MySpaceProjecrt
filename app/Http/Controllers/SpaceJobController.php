<?php

namespace App\Http\Controllers;

use App\Events\TaskCreated;
use App\Jobs\SendEmail;
use App\Models\SpaceJob;
use App\Models\task;
use Illuminate\Http\Request;
use App\Models\Space;
use Illuminate\Support\Facades\Auth;

class SpaceJobController extends Controller
{
    public function store(Space $space)
    {
        $this->authorize('view', $space);
        $data = request()->validate([
            'name' => 'string',
            'desctiption' => 'string',
            'status' => 'string',
            'date_finist' => 'string',
            'file' => 'string',
        ]);
        $data['date_create'] = date("Y-m-d H:i:s");
        $data['space_id'] = $space->id;
        SpaceJob::create($data);
    }
    public function show(Space $space)
    {
        $this->authorize('view', $space);
        $jobs = SpaceJob::where('space_id', $space->id)->get();
    }

    public function update(Request $request, Space $space, SpaceJob $job){

        $this->authorize('view', $space);
        $data = request()->validate([
            'name' => 'string',
            'desctiption' => 'string',
            'status' => 'string',
            'date_finist' => 'string',
            'file' => 'string',
        ]);
        $data['date_create'] = date("Y-m-d H:i:s");
        $data['space_id'] = $space->id;
        $job->update($data);
    }
    public function destroy(Request $request, Space $space, SpaceJob $job){
        $this->authorize('view', $space);
        $job->delete();
    }
}
