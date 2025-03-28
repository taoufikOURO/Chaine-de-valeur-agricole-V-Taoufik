<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statut extends Model
{
    public function parcelle() {
        return $this->hasMany(Parcelle::class);
    }
}
