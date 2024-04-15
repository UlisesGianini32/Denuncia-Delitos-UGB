<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Witne extends Model
{
    use HasFactory;
    protected $fillable = [
        'witness_id',
        'witness_name'
    ];
}
