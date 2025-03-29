<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semis extends Model
{
    public function culture() {
        return $this->belongsTo(Culture::class);
    }
    public function recolte() {
        return $this->belongsTo(Recolte::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function arrosage() {
        return $this->hasMany(Arrosage::class);
    }
    public function parcelle() {
        return $this->belongsTo(Parcelle::class);
    }

    protected $fillable = [
        'date_semis',
        'culture_id',
        'user_id',
        'parcelle_id',
        'recolte_id',
    ];

}
