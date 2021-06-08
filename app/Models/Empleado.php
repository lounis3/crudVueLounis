<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    protected $hidden=["created_at", "updated_at"];
    protected $fillable = [
        'dni',
        'nombre',
        'apellidos',
        'direccion',
        'telefono',
        'estudios',
    ];

    public function empleados()
    {
        return $this->belongsToMany(Empleado::class);
    }
}
