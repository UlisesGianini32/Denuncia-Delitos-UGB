<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lot extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'rpe',
        'producto',
        'cantidad',
        'producto_2',
        'cantidad_2',
        'producto_3',
        'cantidad_3',
        'producto_4',
        'cantidad_4',
        'imagen',
        'firma',
        'rpe2'
    ];

    public function productos(){
        return $this->belongsTo(Product::class);
    }
}
