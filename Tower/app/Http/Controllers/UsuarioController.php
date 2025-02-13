<?php

namespace App\Http\Controllers;

use App\Models\Usuario; // Importando o modelo Usuario
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    // Método para autenticar o usuário
    public function login(Request $request)
    {
        // Validação dos dados de entrada
        $request->validate([
            'Nome' => 'required|string',
            'senha' => 'required|string',
        ]);

        // Verifique se o usuário existe
        $usuario = Usuario::where('Nome', $request->Nome)->first();
        if (!$usuario) {
            \Log::info('Usuário não encontrado', ['Nome' => $request->Nome]);
            return response()->json(['error' => 'Usuário não encontrado'], 404);
        }

        // Verifique a senha
        if (Hash::check($request->senha, $usuario->senha)) {
            Auth::login($usuario); // Loga o usuário
            return response()->json(['message' => 'Login bem-sucedido'], 200);
        }

        return response()->json(['error' => 'Credenciais inválidas'], 401);
    }

    // Método para atualizar um usuário
    public function update(Request $request, $id)
{
    // Validar os dados de entrada e logar a requisição
    \Log::info('Atualizando usuário', ['id' => $id, 'data' => $request->all()]);
    $request->validate([
        'Nome' => 'required|string',
        'função' => 'required|integer',
    ]);

    // Encontrar o usuário pelo ID
    $usuario = Usuario::find($id);
    if (!$usuario) {
        return response()->json(['error' => 'Usuário não encontrado'], 404);
    }

    // Atualizar as informações do usuário
    try {
        $usuario->fill($request->only(['Nome', 'função']));
        $usuario->save();

        return response()->json(['message' => 'Usuário atualizado com sucesso'], 200);
    } catch (\Exception $e) {
        \Log::error('Erro ao atualizar usuário', ['id' => $id, 'error' => $e->getMessage()]);
        return response()->json(['error' => 'Erro ao atualizar usuário. Tente novamente.'], 500);
    }
}

    // Método para obter informações do usuário autenticado
    public function getUser(Request $request)
    {
        return response()->json($request->user());
    }

    // Método para obter as fichas do usuário autenticado
    public function getFichas(Request $request)
    {
        $user = $request->user();
        return response()->json($user->fichas()->select('id', 'nome', 'descricao')->get()); // Retorna apenas os campos necessários
    }

    // Método para logout
    public function logout(Request $request)
    {
        Auth::logout();
        return response()->json(['message' => 'Logout realizado com sucesso.']);
    }

    public function index()
    {
        $usuarios = Usuario::all(); // Obtém todos os usuários do banco de dados
        return response()->json($usuarios); // Retorna os usuários em formato JSON
    }
}
