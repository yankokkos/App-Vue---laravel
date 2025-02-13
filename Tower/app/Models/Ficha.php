<?php

// Tower\app\Models\Ficha.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ficha extends Model
{
    use HasFactory;

    // Defina a tabela que este modelo usará
    protected $table = 'fichas'; // A tabela no banco de dados

    // Defina os campos que podem ser preenchidos em massa
    protected $fillable = [
        'nome',
        'idade',
        'altura',
        'peso',
        'cabelos',
        'olhos',
        'aparencia_personalidade',
        'jogador',
        'patente',
        'for',
        'des',
        'con',
        'int',
        'sab',
        'car',
        'poder',
        'pvs',
        'pes',
        'pss',
        'pontos_narrativos',
        'pontos_acao',
        'pontos_xp',
        'historia',
        'usuario_id', // Chave estrangeira que relaciona a ficha ao usuário
        'pvs_atual',
        'pss_atual',
        'pes_atual',
        'tipo',
        'seed',
        'forca_adicional',
        'destreza_adicional',
        'constituicao_adicional',
        'inteligencia_adicional',
        'sabedoria_adicional',
        'carisma_adicional',
        'pvs_adicionais',
        'pss_adicionais',
        'pes_adicionais',
        'poder_adicional',
    ];

    // Relacionamento com o modelo Usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id'); // Relacionamento inverso
    }

    // Relacionamento com aliados
    public function aliados()
    {
        return $this->hasMany(Aliado::class, 'ficha_id'); // Relacionamento com aliados
    }

    // Relacionamento com anotações
    public function anotacoes()
    {
        return $this->hasMany(Anotacao::class, 'ficha_id'); // Relacionamento com anotações
    }

    // Relacionamento com habilidades especiais
    public function habilidadesEspeciais()
    {
        return $this->hasMany(HabilidadeEspecial::class, 'ficha_id'); // Relacionamento com habilidades especiais
    }

    // Relacionamento com desvantagens
    public function desvantagens()
    {
        return $this->hasMany(Desvantagem::class, 'ficha_id'); // Relacionamento com desvantagens
    }

    // Relacionamento com equipamentos
    public function equipamentos()
    {
        return $this->hasMany(Equipamento::class, 'ficha_id'); // Relacionamento com equipamentos
    }

    // Relacionamento com inimigos
    public function inimigos()
    {
        return $this->hasMany(Inimigo::class, 'ficha_id'); // Relacionamento com inimigos
    }

    // Relacionamento com medos
    public function medos()
    {
        return $this->hasMany(Medo::class, 'ficha_id'); // Relacionamento com medos
    }

    // Relacionamento com missões
    public function missoes()
    {
        return $this->hasMany(Missao::class, 'ficha_id'); // Relacionamento com missões
    }

    // Relacionamento com perícias
    public function pericias()
    {
        return $this->hasMany(Pericia::class, 'ficha_id'); // Relacionamento com perícias
    }

    // Relacionamento com vantagens
    public function vantagens()
    {
        return $this->hasMany(Vantagem::class, 'ficha_id'); // Relacionamento com vantagens
    }

    // Relacionamento com seeds
    public function seeds()
    {
        return $this->hasMany(Seed::class, 'ficha_id'); // Relacionamento com seeds
    }
}