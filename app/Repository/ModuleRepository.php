<?php

namespace App\Repository;

use App\Models\Module;
use Illuminate\Support\Facades\Cache;

class ModuleRepository
{
    protected $entity;

    public function __construct(Module $module)
    {
        $this->entity = $module;
    }

    public function getModuleCourse(int $courseId)
    {
        return $this->entity
            ->where('course_id', $courseId)
            ->get();
    }

    public function createNewModule(int $courseId, array $data)
    {
        $data['course_id'] = $courseId;

        return $this->entity->create($data);
    }

    public function getModuleByCourse(int $courseId, string $uuid)
    {
        return $this->entity
            ->where('course_id', $courseId)
            ->where('uuid', $uuid)
            ->firstOrfail();
    }

    public function getModuleByUuid(string $uuid)
    {
        return $this->entity
            ->where('uuid', $uuid)
            ->firstOrfail();
    }

    public function updateModuleByUuid(int $courseId, string $uuid, array $data)
    {
        $module = $this->getModuleByUuid($uuid);

        Cache::forget('courses');

        $data['course_id'] = $courseId;


        return $module->update($data);
    }

    public function deleteModuleByUuid(string $uuid)
    {
        $module = $this->getModuleByUuid($uuid);

        Cache::forget('courses');

        return $module->delete();
    }
}
