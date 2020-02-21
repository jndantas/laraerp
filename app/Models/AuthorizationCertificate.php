<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthorizationCertificate extends Model
{
    protected $fillable = [
        'document_number',
        'start_date',
        'end_date'
    ];

    public function inputs()
	{
		return $this->hasMany(Input::class);
	}
}
