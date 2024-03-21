<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_complaint',
        'description',
        'complaint_status',
        'id_victim',
        'id_witness',
        'id_suspect'
    ];
}
