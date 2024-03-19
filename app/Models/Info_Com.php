<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info_Com extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'age',
        'ocupation',
        'description',
        'cell_phone',
    ];
}
