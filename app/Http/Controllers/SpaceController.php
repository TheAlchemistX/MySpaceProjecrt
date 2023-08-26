<?php

namespace App\Http\Controllers;

use App\Events\TaskCreated;
use App\Http\Requests\SpaceRequest;
use App\Jobs\SendEmail;
use App\Models\SpaceJob;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Space;
use Illuminate\Support\Facades\Auth;

class SpaceController extends Controller
{

    public function store(SpaceRequest $request)
    {
        $data = $request->validated();
        if (!empty($data)) {
            $data['user_id'] = Auth::id();
            Space::create($data);
            print_r($data);
        } else {
            print_r('Заполните данные');
        }
    }

    public function show()
    {
        $user = User::findOrFail(Auth::id());
        print_r($user->spaces);
    }

    public function update(Space $space, SpaceRequest $request)
    {
        $this->authorize('privateSpace', $space);
        $data = $request->validated();
        $space->update($data);
        print_r($data);

    }

    public function destroy(Space $space)
    {
        $this->authorize('privateSpace', $space);
        $space->delete();
    }
}
