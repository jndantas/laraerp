<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reminder extends Model
{
    protected $fillable = [
        'stock_min',
        'product_id'
    ];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function product()
    {
        return $this->belongsTo(Product::class)->withTrashed();
    }
}
