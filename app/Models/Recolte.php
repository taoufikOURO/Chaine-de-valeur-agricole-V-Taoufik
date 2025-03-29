<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recolte extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function semis()
    {
        return $this->belongsTo(Semis::class);
    }
    public function parcelle()
    {
        return $this->belongsTo(Parcelle::class);
    }
    protected $fillable = [
        'date_recolte',
        'quantite_recolte',
        'user_id',
        'parcelle_id',
        'semis_id',
    ];
}
