<?php

namespace Modules\ProductManagement\App\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\ProductManagement\App\Models\Product;

class ProductOutOfStockMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    public $product;
    public function __construct(Product $product)
    {
        //
        $this->product = $product;
    }

    /**
     * Build the message.
     */
    public function build(): self
    {
        return $this->view('productmanagement::emails.outOfStockProduct')
            ->subject('Product is out of stock' .  $this->product->id)
            ->with(['data' => $this->product]);
    }
}
