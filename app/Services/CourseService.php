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
        return $this -> repository -> storeNewCourse($data);
    }
}
