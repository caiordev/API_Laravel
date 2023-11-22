<?php

namespace Tests\Feature;

use App\Models\Tarefa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class TarefaControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_tarefa_get_endpoint()
    {
        $tarefas = Tarefa::factory(3)->create();
        $response = $this->getJson('/api/tarefa');

        $response->assertStatus(200);
        $response->assertJsonCount(3);

        $response->assertJson(function (AssertableJson $json) use($tarefas){
            $json->whereAllType([
                '0.id'=> 'integer',
                '0.titulo'=> 'string',
                '0.descricao'=> 'string',
                '0.status'=> 'string'
            ]);

            $json->hasAll(['0.id', '0.titulo', '0.descricao', '0.status']);
            $tarefa = $tarefas->first();
            $json->whereAll([
                '0.id' => $tarefa->id,
                '0.titulo'=>$tarefa->titulo,
                '0.descricao'=>$tarefa->descricao,
                '0.status'=>$tarefa->status,
            ]);
        });
    }
}
