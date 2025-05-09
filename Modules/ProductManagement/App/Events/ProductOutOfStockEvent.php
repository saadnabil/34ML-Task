<?php

namespace Modules\ProductManagement\App\Events;

use Illuminate\Queue\SerializesModels;
use Modules\ProductManagement\App\Models\Product;

class ProductOutOfStockEvent
{
    use SerializesModels;

    /**
     * Create a new event instance.
     */

     public $product;

    public function __construct(Product $product)
    {
        //

        $this->product = $product;
    }

    /**
     * Get the channels the event should be broadcast on.
     */
    public function broadcastOn(): array
    {
        return [];
    }
}
