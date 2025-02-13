<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Importando a classe correta
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuario extends Authenticatable // Estendendo a classe Authenticatable
{
    use HasFactory, Notifiable; // Incluindo o trait Notifiable

    // Defina a tabela que este modelo usará
    protected $table = 'usuarios'; // A tabela no banco de dados

    // Defina os campos que podem ser preenchidos em massa
    protected $fillable = [
        'Nome',
        'senha',
        'função', // Se 'função' for um campo que armazena o tipo de usuário, considere usar um enum ou uma tabela separada
    ];

    // Se você quiser ocultar a senha ao serializar o modelo
    protected $hidden = [
        'senha',
    ];

    // Defina o relacionamento com o modelo Ficha
    public function fichas()
    {
        return $this->hasMany(Ficha::class, 'usuario_id'); // Relacionamento com fichas
    }
}