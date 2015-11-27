<?php

namespace App\Listeners;

use App\Events\OnUserLogin;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CollectDataAfterLogin
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
     * @param  OnUserLogin  $event
     * @return void
     */
    public function handle(OnUserLogin $event)
    {
        //
    }
}
