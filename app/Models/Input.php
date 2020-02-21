<?php

namespace App\Models;

use App\Events\StockEntryCreated;
use Illuminate\Database\Eloquent\Model;

class Input extends Model
{
    protected $dispatchesEvents = [
        'created' => StockEntryCreated::class
    ];
    protected $fillable = [
        'date',
        'qntd',
        'authorization_certificate_id',
        'value',
        'document_number',
        'product_id',
        'user_id'
    ];

    public function product()
	{
		return $this->belongsTo(Product::class);
    }
    public function authorizationCertificate()
    {
        return $this->belongsTo(AuthorizationCertificate::class);
    }
}
