<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Tarea;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TareaTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function get_tareas()
    {
       // $user = User::factory()->create();

        $tarea = new Tarea();
        $tarea->titulo = "testTitulo";
        $tarea->descripcion = "testDescripcion";
        $tarea->save();

        $response = $this->getJson('api/tareas');
        $response->assertStatus(200);

        $response->assertJsonFragment([
            'id' => $tarea->id,
            'titulo' => 'Titulo: '. $tarea->titulo,
            'descripcion' => 'Desc: '. $tarea->descripcion,
            'etiquetas' => $tarea->etiquetas
        ]);
    }
}
