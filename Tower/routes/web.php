<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FichaController;
use App\Models\Ficha; // Certifique-se de importar o modelo Ficha

// Rota para a página inicial
Route::get('/', function () {
    return view('welcome');
});

// Rota para a página de teste
Route::get('/test', function () {
    return view('test'); // Retorna a view de teste
})->name('test');

// Rotas para gerenciamento de usuários
Route::prefix('api/usuarios')->group(function () {
    Route::get('/', [UsuarioController::class, 'index']); // Listar todos os usuários
    Route::get('/{id}', [UsuarioController::class, 'show']); // Mostrar um usuário específico
    Route::post('/', [UsuarioController::class, 'store']); // Criar um novo usuário
    Route::put('/{id}', [UsuarioController::class, 'update']); // Atualizar um usuário
    Route::delete('/{id}', [UsuarioController::class, 'destroy']); // Deletar um usuário
});

// Rotas para gerenciamento de fichas
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/fichas', [FichaController::class, 'index']); // Listar todas as fichas
    Route::get('/fichas/{id}', [FichaController::class, 'show']); // Mostrar uma ficha específica
    Route::post('/fichas', [FichaController::class, 'store']); // Criar uma nova ficha
    Route::put('/fichas/{id}', [FichaController::class, 'update']); // Atualizar uma ficha
    Route::delete('/fichas/{id}', [FichaController::class, 'destroy']); // Deletar uma ficha
});

// Rota para a página de login
Route::get('login', function () {
    return view('login'); // Retorna a view de login
})->name('login');

// Rota para autenticação
Route::post('login', [UsuarioController::class, 'login']);

// Rota para obter informações do usuário autenticado
Route::get('/api/user', function (Request $request) {
    return response()->json($request->user()); // Retorna os dados do usuário autenticado
})->middleware('auth'); // Protegendo a rota com middleware de autenticação

// Rota para obter fichas do usuário autenticado
Route::get('/api/fichas', function (Request $request) {
    $user = $request->user(); // Obtém o usuário autenticado

    // Verifica se o usuário é um mestre
    if ($user->função === 1) {
        // Retorna todas as fichas
        $fichas = Ficha::all(); // Obtém todas as fichas do banco de dados
    } else {
        // Retorna apenas as fichas associadas ao usuário
        $fichas = $user->fichas; // Obtém as fichas associadas ao usuário
    }

    return response()->json($fichas); // Retorna as fichas em formato JSON
})->middleware('auth'); // Protegendo a rota com middleware de autenticação

// Rota para logout
Route::post('/logout', function (Request $request) {
    Auth::logout(); // Realiza o logout do usuário
    return response()->json(['message' => 'Logout realizado com sucesso.']); // Retorna mensagem de sucesso
})->middleware('auth'); // Protegendo a rota com middleware de autenticação
