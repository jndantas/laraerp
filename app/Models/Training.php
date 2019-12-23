<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Training extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

	public function employees()
    {
        return $this->belongsToMany(Employee::class)->withTrashed()->withPivot('date');
    }
}
