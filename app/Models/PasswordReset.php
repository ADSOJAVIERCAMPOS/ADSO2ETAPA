<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    // La tabla asociada con el modelo.
    protected $table = 'password_reset_tokens';

    // Los atributos que se pueden asignar masivamente.
    protected $fillable = ['email', 'token', 'created_at'];

    // Desactivar los timestamps si no los usas
    public $timestamps = false;

    // Si el campo 'token' no es una columna autoincremental
    protected $primaryKey = 'token';
}
