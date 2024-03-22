<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;
    protected $fillable = [
        'complaint_id',
        'description',
        'complaint_status',
        'victim_id',
        'witness_id',
        'suspect_id'
    ];
}
