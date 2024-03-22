<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint_status extends Model
{
    use HasFactory;
    protected $fillable = [
        'complaint_id',
        'complaint_status',
    ];
}
