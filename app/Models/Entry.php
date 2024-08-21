<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $table = 'entry';
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'nombre',
        'rpe',
    ];
}
