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
        return $this -> entity ->with('modules.lessons')-> get();
    }

    public function storeNewCourse( array $data )
    {
        return $this -> entity -> create( $data );
    }

    public function getCourseByUuid( string $uuid,bool $loadRelationships = true )
    {
//        return $this -> entity -> where( 'uuid', $uuid )->with('modules.lessons') -> firstOrFail();
        $query = $this->entity->where('uuid', $uuid);

        if ($loadRelationships)
            $query->with('modules.lessons');

        return $query->firstOrfail();
    }

    public function deleteCourseByUuid( string $uuid )
    {
        //Reaproveito o metodo getCourseByUuid() para pegar o curso
        $course = $this -> getCourseByUuid( $uuid ,false);
        return $course -> delete();
    }

    public function updateCourseByUuid( string $uuid,array $data  )
    {
        //Reaproveito o metodo getCourseByUuid() para pegar o curs
        $course = $this -> getCourseByUuid( $uuid ,false);
        return $course -> update($data);
    }
}
