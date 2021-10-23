<?php

namespace App\Services;

use App\Repository\ModuleRepository;
use App\Repository\CourseRepository;


class ModuleService
{
    protected $moduleRepository, $courseRepository;

    public function __construct(
        ModuleRepository $moduleRepository,
        CourseRepository $courseRepository
    ) {
        $this->moduleRepository = $moduleRepository;
        $this->courseRepository = $courseRepository;
    }

    public function getModulesByCourse(string $course)
    {
        $course = $this->courseRepository->getCourseByUuid($course);

        return $this->moduleRepository->getModuleCourse($course->id);
    }

    public function createNewModule(array $data)
    {
        $course = $this->courseRepository->getCourseByUuid($data['course']);

        return $this->moduleRepository->createNewModule($course->id, $data);
    }

    public function getModuleByCourse(string $course, string $uuid)
    {
        $course = $this->courseRepository->getCourseByUuid($course);

        return $this->moduleRepository->getModuleByCourse($course->id, $uuid);
    }

    public function updateModule(string $uuid, array $data)
    {
        $course = $this->courseRepository->getCourseByUuid($data['course']);

        return $this->moduleRepository->updateModuleByUuid($course->id, $uuid, $data);
    }

    public function deleteModule(string $uuid)
    {
        return $this->moduleRepository->deleteModuleByUuid($uuid);
    }
}
