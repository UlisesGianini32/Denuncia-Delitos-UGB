<?php

namespace App\Models;

use App\Models\Victim;
use App\Models\Suspect;
use App\Models\Witne;
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

    public function victim(){
        return $this->belongsTo(Victim::class);
    }

    public function suspect(){
        return $this->belongsTo(Suspect::class);
    }

    public function witness(){
        return $this->belongsTo(Witne::class);
    }
}
