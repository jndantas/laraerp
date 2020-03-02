<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = [
        'name',
        'description',
        'enterprise_id',
        'sector_id'
    ];

    public function enterprise()
    {
        return $this->belongsTo(Enterprise::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }


}
