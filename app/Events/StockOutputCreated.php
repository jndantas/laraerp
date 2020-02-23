<?php

namespace App\Events;

use App\Models\Output;

class StockOutputCreated
{

    private $output;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Output $output)
    {
        $this->output = $output;
    }

    public function getOutput()
    {
        return $this->output;
    }


}
