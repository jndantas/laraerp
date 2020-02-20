<?php

namespace App\Events;

use App\Models\Input;

class StockEntryCreated
{

    private $entry;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Input $entry)
    {
        $this->entry = $entry;
    }

    public function getEntry()
    {
        return $this->entry;
    }

}
