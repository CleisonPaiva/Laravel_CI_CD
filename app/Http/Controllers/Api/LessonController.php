<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LessonRequest;
use App\Http\Resources\LessonResource;
use App\Services\LessonService;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    protected $lessonService;

    public function __construct(LessonService $lessonService)
    {
        $this->lessonService = $lessonService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($module)
    {
        $lessons = $this->lessonService->getLessonsByModule($module);

        return LessonResource::collection($lessons);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LessonRequest $request, $module)
    {
        $module = $this->lessonService->createNewLesson($request->validated());

        return new LessonResource($module);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function show($module, $uuid)
    {
        $module = $this->lessonService->getLessonByModule($module, $uuid);

        return new LessonResource($module);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function update(LessonRequest $request, $module, $uuid)
    {
        $this->lessonService->updateLesson($uuid, $request->validated());

        return response()->json(['message' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy($module, $uuid)
    {
        $this->lessonService->deleteLesson($uuid);

        return response()->json([], 204);
    }
}
