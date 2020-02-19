<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Input extends Model
{
    protected $fillable = [
        'qntd',
        'product_id'
    ];

    public function product()
	{
		return $this->belongsTo(Product::class);
	}
}
