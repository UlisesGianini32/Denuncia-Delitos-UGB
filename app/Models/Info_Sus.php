<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info_Sus extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'age',
        'ocupation',
        'description',
        'background',
        'addres',
    ];
}
