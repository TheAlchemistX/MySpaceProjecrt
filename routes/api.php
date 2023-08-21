<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobAddController;
use App\Http\Controllers\SpaceAddController;
use App\Http\Controllers\SpaceController;
use App\Http\Controllers\SpaceJobController;
use App\Http\Controllers\SpaceJobTaskController;
use App\Http\Controllers\TaskAddController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});
Route::group(['middleware' => 'jwt.auth'], function(){

    //create
    Route::post('/space/store', [SpaceController::class, 'store']); //создание пространства
    Route::post('/space/{space}/job/store', [SpaceJobController::class, 'store']); //создание задачи в пространстве
    Route::post('/space/{space}/{job}/task/store', [SpaceJobTaskController::class, 'store']); //создание задания в задаче в пространства

    //read
    Route::get('/space/show', [SpaceController::class, 'show']); //Список пространств
    Route::get('/space/{space}/show', [SpaceJobController::class, 'show']); //Список задач в пространстве
    Route::get('/space/{space}/{job}/show', [SpaceJobTaskController::class, 'show']); //Список заданий в задаче в пространства

    //update
    Route::patch('/space/{space}/update', [SpaceController::class, 'update']); //редактирование пространства
    Route::patch('/space/{space}/{job}/update', [SpaceJobController::class, 'update']); //Редактирование задачи в пространстве
    Route::patch('/space/{space}/{job}/{task}/update', [SpaceJobTaskController::class, 'update']); //Редактирование задания в задаче в пространстве

    //delete
    Route::post('/space/{space}/delete', [SpaceController::class, 'destroy']); //редактирование пространства
    Route::post('/space/{space}/{job}/delete', [SpaceJobController::class, 'destroy']); //Редактирование задачи в пространстве
    Route::post('/space/{space}/{job}/{task}/delete  ', [SpaceJobTaskController::class, 'destroy']); //Редактирование задания в задаче в пространстве

});


