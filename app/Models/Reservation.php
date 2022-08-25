<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{

    public function Performance(){
        return $this->belongsTo(Performance::class, "performance_id","per_id");
    }
    use HasFactory;
}
