<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla en la base de datos
    //protected $table = 'product';

    // Especifica los campos que pueden ser llenados masivamente
    protected $primaryKey = 'product_id';
    protected $fillable = [
        'codigo',
        'nombre',
        'expiracion',
        'stock_inicial',
        'entrada',
        'salida',
        'existencia'
    ];
}

