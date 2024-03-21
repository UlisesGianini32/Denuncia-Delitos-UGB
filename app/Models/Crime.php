<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crime extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_complaint',
        'crime_name',
        'crime_description'
    ];
}
