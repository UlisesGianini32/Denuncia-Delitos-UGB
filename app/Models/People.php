<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;
    protected $fillable = [
        'people_id',
        'full_name',
        'age',
        'address',
        'city',
        'phone',
        'email',
    ];
}
