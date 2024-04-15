<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suspect extends Model
{
    use HasFactory;
    protected $fillable = [
        'suspect_id',
        'suspect_name',
    ];
}
