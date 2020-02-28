<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function sectors()
    {
        return $this->belongsToMany(Sector::class);
    }
}
