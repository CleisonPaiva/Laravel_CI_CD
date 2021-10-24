<?php

use App\Http\Controllers\Api\{
    CourseController,
    LessonController,
    ModuleController};

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::apiResource('/modules/{module}/lessons', LessonController::class);

Route::apiResource('/courses/{course}/modules', ModuleController::class);

Route::apiResource('/courses',CourseController::class);

Route::get('/', function () {
    return response()->json(['message'=>'ok']);
});
