<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'document_number',
        'enterprise_id',
        'position_id'
    ];
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function enterprise()
    {
        return $this->belongsTo(Enterprise::class);
    }

    public function positions()
    {
        return $this->belongsToMany(Position::class);
    }

    public function position()
    {
        return $this->belongsToMany(Position::class)->latest();
    }

    public function exams()
    {
        return $this->belongsToMany(Exam::class)->withTrashed()->withPivot('date');
    }

    public function trainings()
    {
        return $this->belongsToMany(Training::class)->withTrashed()->withPivot('date');
    }

    public function outputs()
    {
        return $this->hasMany(Output::class);
    }
}
