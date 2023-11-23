<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\TarefaRequest;
use App\Models\Tarefa;
use App\Http\Controllers\Exception;
use Illuminate\Http\Request;

class TarefaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
        return response()->json(Tarefa::all());
        }catch(Exception $e){
            return response()->json(['error'=>$e->getMessage()], 400);
    }
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TarefaRequest $request)
    {
        try {
            $tarefa = Tarefa::create($request->all());
            return response()->json($tarefa, 201);
        } catch (\Exception $e) {
            // Tratamento de erro genérico
            return response()->json(['error' => 'Ocorreu um erro ao criar a tarefa.'], 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Tarefa::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $tarefa = Tarefa::find($id);
        $tarefa->update($request->all());
        return response()->json($tarefa);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tarefa = Tarefa::find($id);
        $tarefa->delete();
        return response()->json([], 204);
    }


    /**
 * Update the status of the specified resource in storage.
 *
 * @param \Illuminate\Http\Request $request
 * @param int $id
 * @return \Illuminate\Http\Response
 */
public function updateStatus(Request $request, $id)
{
   $tarefa = Tarefa::find($id);
   $tarefa->status = $request->status;
   $tarefa->save();
   return response()->json($tarefa);
}

}
