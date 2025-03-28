<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeCulture extends Model
{
    public function culture() {
        return $this->hasMany(Culture::class);
    }
}
