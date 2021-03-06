<?php

namespace App\Models;

use App\Events\StockOutputCreated;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Output extends Model
{
    protected $dispatchesEvents = [
        'created' => StockOutputCreated::class
    ];
    protected $fillable = [
        'qntd',
        'employee_id',
        'content',
        'product_id',
        'user_id'
    ];

	public function product()
	{
		return $this->belongsTo(Product::class);
    }

	public function employee()
	{
		return $this->belongsTo(Employee::class)->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeHistoric($query)
    {
        return $query
        ->leftjoin('products','product_id','=','products.id')
        ->select(DB::raw('sum(qntd) as qntd_period, CONCAT(products.name ," ", products.measure) as nome,products.measure as size, products.id as id'))
        ->groupBy('product_id');
    }
    public function scopeHistoricData($query, $type)
    {
        return $query->Historic()->whereBetween('date',$type);
    }
    public function scopeHistoricoLastMonth($query, $type)
    {
        return $query->Historic()->where('outputs.created_at','>=',$type);
    }
}
