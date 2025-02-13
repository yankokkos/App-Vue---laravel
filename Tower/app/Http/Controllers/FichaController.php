<?php

// Tower\app\Http\Controllers\FichaController.php
namespace App\Http\Controllers;

use App\Models\Ficha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FichaController extends Controller
{
    // Método para listar todas as fichas do usuário autenticado
    public function index()
    {
        $user = Auth::user();
        return response()->json($user->fichas); // Retorna as fichas associadas ao usuário
    }

    // Método para mostrar uma ficha específica
    public function show($id)
    {
        $ficha = Ficha::findOrFail($id);
        return response()->json($ficha);
    }

    // Método para criar uma nova ficha
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            // Adicione outras validações conforme necessário
        ]);

        $ficha = new Ficha($request->all());
        $ficha->usuario_id = Auth::id(); // Associa a ficha ao usuário autenticado
        $ficha->save();

        return response()->json($ficha, 201); // Retorna a ficha criada
    }

    // Método para atualizar uma ficha existente
    public function update(Request $request, $id)
    {
        $ficha = Ficha::findOrFail($id);
        $ficha->update($request->all());

        return response()->json($ficha);
    }

    // Método para deletar uma ficha
    public function destroy($id)
    {
        $ficha = Ficha::findOrFail($id);
        $ficha->delete();

        return response()->json(['message' => 'Ficha deletada com sucesso.']);
    }
}