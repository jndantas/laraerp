<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enterprise extends Model
{
    protected $fillable = [
        'name',
        'title',
        'document_number'
    ];

    public function sectors()
    {
        return $this->belongsToMany(Sector::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
