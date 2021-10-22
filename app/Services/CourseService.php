<?php

namespace App\Services;

use App\Repository\CourseRepository;

class CourseService
{

    protected $repository;

    public function __construct( CourseRepository $courseRepository )
    {
        $this -> repository = $courseRepository;
    }

    public function getCoursesAll()
    {
        return $this -> repository -> getCoursesAll();
    }

    public function storeNewCourse( array $data )
    {
        return $this -> repository -> storeNewCourse( $data );
    }

    public function getCourse( string $uuid )
    {
        return $this -> repository -> getCourseByUuid( $uuid );
    }

    public function deleteCourse( string $uuid )
    {
        return $this -> repository -> deleteCourseByUuid( $uuid );
    }
}
