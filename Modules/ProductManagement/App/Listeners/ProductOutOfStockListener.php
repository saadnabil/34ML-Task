<?php

namespace Modules\ProductManagement\App\Listeners;

use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\AdminManagement\App\Models\Admin;
use Modules\ProductManagement\App\Emails\ProductOutOfStockMail;
use Modules\ProductManagement\App\Events\ProductOutOfStockEvent;

class ProductOutOfStockListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ProductOutOfStockEvent $event): void
    {

        Mail::to(Admin::first()->email ?? 'admin@34ml.com')->send(new ProductOutOfStockMail($event->product));        
    }
}
