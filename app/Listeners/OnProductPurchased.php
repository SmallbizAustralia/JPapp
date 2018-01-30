<?php

namespace App\Listeners;

use App\Events\ProductPurchased;
use App\Mail\Ebook as EbookMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class OnProductPurchased implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ProductPurchased  $event
     * @return void
     */
    public function handle(ProductPurchased $event)
    {
        $product = $event->product;
        if($product->isEbook()) {
            Mail::to($product->user)->send(new EbookMail());
        }
    }
}
