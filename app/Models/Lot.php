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
        'codigo',
        'rpe',
        'productos',
        'cantidad',
        'productos 2',
        'cantidad 2',
        'productos 3',
        'cantidad 3',
        'productos 4',
        'cantidad 4',
        'imagen',
        'firma',
        'rpe2'
    ];

    public function productos(){
        return $this->belongsTo(Product::class);
    }
}
