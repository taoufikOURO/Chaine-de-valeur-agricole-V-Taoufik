<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fertilisation extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function parcelle()
    {
        return $this->belongsTo(Parcelle::class);
    }
    protected $fillable = [
        'date_fertilisation',
        'user_id',
        'parcelle_id',
        'description'
    ];
}
