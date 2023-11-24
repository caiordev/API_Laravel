<?php

namespace Database\Seeders;

use App\Models\Tarefa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TarefaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tarefa::create([
        "id"=> 1,
        "titulo"=>"fazer atividade",
        "descricao"=>"fazer atividade de matemática",
        "status"=> false,
        "created_at"=> "2023-11-22T23:17:46.000000Z",
        "updated_at"=> "2023-11-23T15:58:46.000000Z"
        ]);
    }
}
