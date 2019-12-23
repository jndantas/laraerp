<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    protected $fillable = [
        'name',
        'code',
        'duration'
    ];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function employees()
    {
        return $this->belongsToMany(Employee::class)->withPivot('date');
    }
}
