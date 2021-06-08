<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha',
        'descripcion',
        'id_cliente'
    ];

    public function facturas()
    {
        return $this->belongsToMany(Factura::class);
    }
}
