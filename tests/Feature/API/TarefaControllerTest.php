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
    public function test_get_tarefas_endpoint()
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

      /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_single_tarefa_endpoint()
    {
        $tarefa = Tarefa::factory(1)->createOne();
        $response = $this->getJson('/api/tarefa/'. $tarefa->id);

        $response->assertStatus(200);


        $response->assertJson(function (AssertableJson $json) use($tarefa){
            $json->whereAllType([
                'id'=> 'integer',
                'titulo'=> 'string',
                'descricao'=> 'string',
                'status'=> 'string'
            ]);

            $json->hasAll(['id', 'titulo', 'descricao', 'status', 'created_at', 'updated_at']);

            $json->whereAll([
                'id' => $tarefa->id,
                'titulo'=>$tarefa->titulo,
                'descricao'=>$tarefa->descricao,
                'status'=>$tarefa->status,
            ]);
        });
    }

        public function test_post_tarefa_endpoint()
        {
            $tarefa = Tarefa::factory(1)->makeOne()->toArray();


            $response = $this->postJson('/api/tarefa', $tarefa);

            $response->assertStatus(201);

            $response->assertJson(function (AssertableJson $json) use($tarefa){
                $json->hasAll(['id', 'titulo', 'descricao', 'status', 'created_at', 'updated_at']);
                $json->whereAll([
                    'titulo'=>$tarefa['titulo'],
                    'descricao'=>$tarefa['descricao'],
                    'status'=>$tarefa['status'],
                ])->etc();
            });

        }
    }




