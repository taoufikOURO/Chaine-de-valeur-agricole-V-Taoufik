<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Culture extends Model
{
    public function typeCulture()
    {
        return $this->belongsTo(TypeCulture::class);
    }
    public function semis()
    {
        return $this->hasMany(Semis::class);
    }

    protected $fillable = [
        'code',
        'nom',
        'type_culture_id',
    ];
}
