<?php

namespace Modules\ProductManagement\App\Providers;

use Modules\OtpManagement\App\Events\EmailOtpEvent;
use Modules\OtpManagement\App\Listeners\EmailOtpListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\ProductManagement\App\Events\ProductOutOfStockEvent;
use Modules\ProductManagement\App\Listeners\ProductOutOfStockListener;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [

        ProductOutOfStockEvent::class => [
            ProductOutOfStockListener::class
        ]

    ];
}