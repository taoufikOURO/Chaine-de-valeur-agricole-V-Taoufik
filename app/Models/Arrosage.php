<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Arrosage extends Model
{
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function semis() {
        return $this->belongsTo(Semis::class);
    }
}
