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

    public function storeNewCourse( array $data )
    {
        return $this -> entity -> create( $data );
    }

    public function getCourseByUuid( string $uuid )
    {
        return $this -> entity -> where( 'uuid', $uuid ) -> firstOrFail();
    }

    public function deleteCourseByUuid( string $uuid )
    {
        //Reaproveito o metodo getCourseByUuid() para pegar o curso
        $course = $this -> getCourseByUuid( $uuid );
        return $course -> delete();
    }

    public function updateCourseByUuid( string $uuid,array $data  )
    {
        //Reaproveito o metodo getCourseByUuid() para pegar o curs
        $course = $this -> getCourseByUuid( $uuid );
        return $course -> update($data);
    }
}
