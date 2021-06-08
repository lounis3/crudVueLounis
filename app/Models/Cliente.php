<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $fillable = [
        'dni',
        'nombre',
        'apellidos',
        'direccion',
        'telefono',
        'pais',
    ];

    public function clientes()
    {
        return $this->belongsToMany(Cliente::class);
    }
}
