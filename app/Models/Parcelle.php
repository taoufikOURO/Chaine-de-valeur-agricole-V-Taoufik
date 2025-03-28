<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parcelle extends Model
{
    public function statut() {
        return $this->belongsTo(Statut::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function fertilisation() {
        return $this->hasMany(Fertilisation::class);
    }
    public function recolte() {
        return $this->hasMany(Recolte::class);
    }
    public function semis() {
        return $this->hasMany(Semis::class);
    }
}
