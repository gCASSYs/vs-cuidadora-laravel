<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class LoginVania extends Authenticatable
{
    use HasFactory, Notifiable;


    // Alteração da Gabriele - tabela usada para o login administrativo
    protected $table = 'tbl_login_vania';


    // Alteração da Gabriele - chave primária da tabela
    protected $primaryKey = 'id_login_vania';


    // Alteração da Gabriele - nomes personalizados das datas
    const CREATED_AT = 'data_criacao_login_vania';

    const UPDATED_AT = 'data_atualizacao_login_vania';


    // Alteração da Gabriele - campos permitidos
    protected $fillable = [
        'email_login_vania',
        'senha_login_vania',
        'tipo_login_vania',
        'status_login_vania',
    ];


    // Alteração da Gabriele - não exibe a senha em arrays
    protected $hidden = [
        'senha_login_vania',
    ];


    /**
     * Alteração da Gabriele - criptografa a senha automaticamente.
     */
    protected function casts(): array
    {
        return [
            'senha_login_vania' => 'hashed',
        ];
    }


    /**
     * Alteração da Gabriele - informa ao Laravel
     * qual campo contém a senha.
     */
    public function getAuthPasswordName(): string
    {
        return 'senha_login_vania';
    }


    public function getAuthPassword(): string
    {
        return $this->senha_login_vania;
    }

    public function VaniaUsuario() {
        return $this->hasMany(LoginUsuario::class, 'id_login_vania', 'id_login_vania');
    }

    public function VaniaCliente() {
        return $this->hasMany(Cliente::class, 'id_login_vania', 'id_login_vania');
    }
}