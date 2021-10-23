<?php

namespace App\Repository;

use App\Models\Course;
use Illuminate\Support\Facades\Cache;

class CourseRepository
{
    protected $entity;

    public function __construct( Course $course )
    {
        $this -> entity = $course;
    }

    public function getCoursesAll()
    {
        //Armazena o cache por 60 segundos
         return Cache::remember('courses', 60, function () {
             return $this->entity
                     ->with('modules.lessons')
                     ->get();
         });

        //Armazena o cache para sempre
//        return Cache::rememberForever('courses', function () {
//            return $this->entity
//                ->with('modules.lessons')
//                ->get();
//        });
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

//        Remove do Cache
        Cache::forget('courses');
        return $course -> delete();
    }

    public function updateCourseByUuid( string $uuid,array $data  )
    {
        //Reaproveito o metodo getCourseByUuid() para pegar o curs
        $course = $this -> getCourseByUuid( $uuid ,false);

        //        Remove do Cache
        Cache::forget('courses');
        return $course -> update($data);
    }
}
