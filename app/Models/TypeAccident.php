<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeAccident extends Model
{

    protected $table = 'type_accidents';

    protected $fillable = [
        'name',
        'description'
    ];
    public function accidents()
    {
        return $this->hasMany(Accident::class);
    }
}
