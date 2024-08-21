<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $table = 'entries';
    use HasFactory;
    protected $fillable = [
        'rpe',
        'producto',
        'cantidad',
        'foto',
        'firma'
    ];
}
