<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    public function Type(){
        return $this->belongsTo(Type::class, "type_id","id");
    }
    use HasFactory;
}
