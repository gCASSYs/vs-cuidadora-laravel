<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


// Alteração da Gabriele - campos permitidos para cadastro e atualização
#[Fillable([
    'name',
    'email',
    'password',
    'nivel',
    'status',
    'foto',
])]


// Alteração da Gabriele - campos ocultos
#[Hidden([
    'password',
    'remember_token',
])]


class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;


    /**
     * Alteração da Gabriele - conversões automáticas.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',

            // Alteração da Gabriele - criptografa a senha automaticamente
            'password' => 'hashed',
        ];
    }
}