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
        // Cria 3 tarefas no banco de dados
        $tarefas = Tarefa::factory(3)->create();
        // Faz uma requisição GET para o endpoint '/api/tarefa'
        $response = $this->getJson('/api/tarefa');

        // Verifica se a resposta foi bem-sucedida (status 200)
        $response->assertStatus(200);
        // Verifica se a resposta contém 3 itens
        $response->assertJsonCount(3);

        // Verifica se os itens retornados estão no formato correto
        $response->assertJson(function (AssertableJson $json) use($tarefas){

            $json->whereAllType([
                '0.id'=> 'integer',
                '0.titulo'=> 'string',
                '0.descricao'=> 'string',
                '0.status'=> 'string'
            ]);

            $json->hasAll(['0.id', '0.titulo', '0.descricao', '0.status']);
            // Pega a primeira tarefa criada
            $tarefa = $tarefas->first();
            //verifica se é igual.
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
        // Cria uma única tarefa no banco de dados
        $tarefa = Tarefa::factory(1)->createOne();
        // Faz uma requisição GET para o endpoint '/api/tarefa/{id}'
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

            // Faz uma requisição POST para o endpoint '/api/tarefa'
            $response = $this->postJson('/api/tarefa', $tarefa);

            $response->assertStatus(201);
            // Verifica se a resposta contém os campos corretos
            $response->assertJson(function (AssertableJson $json) use($tarefa){
                $json->hasAll(['id', 'titulo', 'descricao', 'status', 'created_at', 'updated_at']);
                $json->whereAll([
                    'titulo'=>$tarefa['titulo'],
                    'descricao'=>$tarefa['descricao'],
                    'status'=>$tarefa['status'],
                ])->etc();
            });

        }
    public function test_post_tarefa_should_validate_when_try_create_a_invalid_book()
        {

             // Faz uma requisição POST para o endpoint '/api/tarefa' com um array vazio
             $response = $this->postJson('/api/tarefa', []);

             // Verifica se a resposta foi um erro de validação (status 422)
            $response->assertStatus(422);

            // Verifica se a resposta contém uma mensagem de erro
             $response->assertJson(function (AssertableJson $json) {
                $json->hasAll(['message', 'errors']);
                $json->where('errors.titulo.0', 'Este campo é obrigatório');
            });
}

        public function test_put_tarefa_endpoint()
        {
            Tarefa::factory(1)->createOne();
            // Define os novos dados da tarefa
            $tarefa = [
                'titulo'=>'Atualizando livro...',
                'descricao'=>'Atualizando livro...',
                'status'=>'Atualizando livro...'
            ];

            //Faz uma requisição PUT para o endpoint '/api/tarefa/{id}'
            $response = $this->putJson('/api/tarefa/1', $tarefa);

            $response->assertStatus(200);

            // Verifica se a resposta contém os campos corretos
            $response->assertJson(function (AssertableJson $json) use($tarefa){
                $json->hasAll(['id', 'titulo', 'descricao', 'status', 'created_at', 'updated_at']);
                $json->whereAll([
                    'titulo'=>$tarefa['titulo'],
                    'descricao'=>$tarefa['descricao'],
                    'status'=>$tarefa['status'],
                ])->etc();
            });



        }

        public function test_delete_tarefa_endpoint()
        {
            //cria a tarefa
            Tarefa::factory(1)->createOne();
            //deleta a tarefa.
            $response = $this->deleteJson('/api/tarefa/1');

            $response->assertStatus(204);

        }
    }




