<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use App\Services\CourseService;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    protected $courseService;

    public function __construct( CourseService $courseService )
    {
        $this -> courseService = $courseService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = $this -> courseService -> getCoursesAll();

        return CourseResource ::collection( $courses );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store( CourseRequest $request )
    {

        $course = $this -> courseService -> storeNewCourse( $request -> validated() );

        return new CourseResource( $course );
        //Por default o resource retorna um status code de 201(created).
    }

    /**
     * Display the specified resource.
     *
     * @param String $course
     * @return \Illuminate\Http\Response
     */
    public function show( $uuid )
    {

        $course = $this -> courseService -> getCourse( $uuid );

        return new CourseResource( $course );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param String $uuid
     * @return \Illuminate\Http\Response
     */
    public function update( CourseRequest $request, $uuid )
    {
        $this->courseService->updateCourse($uuid, $request->validated());

        return response()->json(['message' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param String $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy( $uuid )
    {
        $this -> courseService -> deleteCourse( $uuid );
        return response() -> json( [], 204 );
    }
}
