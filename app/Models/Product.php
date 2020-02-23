<?php

namespace App\Models;

use App\Events\StockEntryCreated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    protected $fillable = [
        'name',
        'measure',
        'category_id',
        'stock_min',
        'authorization_certificate_id'
    ];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function reminders()
    {
        return $this->hasMany(Reminder::class)->withTrashed();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function inputs()
    {
        return $this->hasMany(Input::class);
    }

    public function outputs()

    {
        return $this->hasMany(Output::class);
    }

    public function authorizationCertificate()
    {
        return $this->belongsTo(AuthorizationCertificate::class);
    }

    public function getQntdAttribute()
    {
        $numentradas = $this->inputs->sum('qntd');
        $numsaidas = $this->outputs->sum('qntd');
        return $numentradas-$numsaidas;
    }
}
