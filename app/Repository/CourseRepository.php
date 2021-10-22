<?php

namespace App\Repository;

use App\Models\Course;

class CourseRepository
{
    protected $entity;

    public function __construct( Course $course )
    {
        $this -> entity = $course;
    }

    public function getCoursesAll()
    {
        return $this -> entity -> get();
    }
    public function storeNewCourse(array $data )
    {
        return $this -> entity -> create($data);
    }
}
