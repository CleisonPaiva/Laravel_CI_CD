<?php

namespace Tests\Feature\Api;

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CourseTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    //Retorna todos os Cursos
    public function test_get_all_courses()
    {
        $response = $this->getJson('/api/courses');

        $response->assertStatus(200);
    }

    //Verifica  a quantidade de Curso
    public function test_get_count_courses()
    {
        //Cria 10 Cursos
        Course::factory()->count(10)->create();

        $response = $this->getJson('/api/courses');

        //Verifica se a quantidade retornada e de fato 10 cursos
        $response->assertJsonCount(10, 'data');
        $response->assertStatus(200);
    }

    //Procura um Curso que não existe
    public function test_notfound_courses()
    {
        $response = $this->getJson('/api/courses/fake_value');

        $response->assertStatus(404);
    }

    //Recupera um Curso
    public function test_get_course()
    {
        //Cria o Curso
        $course = Course::factory()->create();

        $response = $this->getJson("/api/courses/{$course->uuid}");

        $response->assertStatus(200);
    }

    //Validacao para o cadastro de um novo Curso
    public function test_validations_create_course()
    {
        $response = $this->postJson('/api/courses', []);

        $response->assertStatus(422);
    }

    //Cria um Curso
    public function test_create_course()
    {
        $response = $this->postJson('/api/courses', [
            'name' => 'Novo Curso'
        ]);

        $response->assertStatus(201);
    }

    //Validacao para editar um  Curso
    public function test_validation_update_course()
    {
        $course = Course::factory()->create();

        $response = $this->putJson("/api/courses/{$course->uuid}", []);

        $response->assertStatus(422);
    }

    //Tenta editar um curso que não existe
    public function test_404_update_course()
    {
        $response = $this->putJson('/api/courses/fake_value', [
            'name' => 'Course Updated'
        ]);

        $response->assertStatus(404);
    }

    //Edita um  Curso
    public function test_update_course()
    {
        $course = Course::factory()->create();

        $response = $this->putJson("/api/courses/{$course->uuid}", [
            'name' => 'Course Updated'
        ]);

        $response->assertStatus(200);
    }

    //Tenta deletar um curso que não existe
    public function test_404_delete_course()
    {
        $response = $this->deleteJson('/api/courses/fake_value');

        $response->assertStatus(404);
    }

    //Deleta um  Curso
    public function test_delete_course()
    {
        $course = Course::factory()->create();

        $response = $this->deleteJson("/api/courses/{$course->uuid}");

        $response->assertStatus(204);
    }
}
