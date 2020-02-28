<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    protected $fillable = [
        'name',
        'enterprise_id'
    ];

    public function enterprises()
    {
        return $this->belongsToMany(Enterprise::class);
    }

    public function positions()
    {
        return $this->belongsToMany(Position::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
