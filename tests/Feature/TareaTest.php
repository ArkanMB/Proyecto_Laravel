<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Tarea;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TareaTest extends TestCase
{
  use RefreshDatabase, WithFaker;

  public function test_get_tareas_all(): void
  {
    $user = User::factory()->create();
    $tarea = new Tarea();
    $tarea->titulo = "testTitulo";
    $tarea->descripcion = "testDescripcion";
    $tarea->save();

    $response = $this->actingAs($user)->getJson('api/tareas');
    $response->assertStatus(200);

    $response->assertJsonFragment([
      'id' => $tarea->id,
      'titulo' => 'Titulo: ' . $tarea->titulo,
      'descripcion' => 'Descripcion: ' . $tarea->descripcion,
      'etiquetas' => 'Etiqueta: []'
    ]);
  }

  public function test_get_una_tarea(): void
  {
    $user = User::factory()->create();
    $tarea = new Tarea();
    $tarea->titulo = "testTitulo";
    $tarea->descripcion = "testDescripcion";
    $tarea->save();

    $response = $this->actingAs($user)->getJson('api/tareas/' . $tarea->id);
    $response->assertStatus(200);

    $response->assertJsonFragment([
      'id' => $tarea->id,
      'titulo' => 'Titulo: ' . $tarea->titulo,
      'descripcion' => 'Descripcion: ' . $tarea->descripcion,
      'etiquetas' => 'Etiqueta: []'
    ]);
  }

}
