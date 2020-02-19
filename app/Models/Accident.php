<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accident extends Model
{
    protected $fillable = [
            'description',
            'procedure',
            'initial_culprit',
            'final_culprit',
            'type_accident_id'
    ];

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'accident_employee');
    }

    public function typeAccident()
    {
        return $this->belongsTo(TypeAccident::class);
    }
}
