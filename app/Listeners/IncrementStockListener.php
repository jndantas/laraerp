<?php

namespace App\Listeners;

use App\Events\StockEntryCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncrementStockListener
{
    /**
     * Handle the event.
     *
     * @param  StockEntryCreated  $event
     * @return void
     */
    public function handle(StockEntryCreated $event)
    {
        $entry = $event->getEntry();
        $product = $entry->product;
        $product->stock = $product->stock + $entry->qntd;
        $product->save();
    }
}
