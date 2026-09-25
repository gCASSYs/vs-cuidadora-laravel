<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class LoginUsuario extends Model{
    protected $table = 'tbl_login_usuario';
    protected $primaryKey = 'id_login_usuario';
    public $timestamps = false;

    protected $fillable = [
        'id_login_vania',
        'email_login',
        'senha_login',
        'tipo_login',
    ];

    public function LoginCliente() {
        return $this->hasOne(Cliente::class, 'id_login', 'id_login_usuario');
    }

    public function UsuarioVania() {
        return $this->belongsTo(LoginVania::class, 'id_login_vania', 'id_login_vania');
    }

}
