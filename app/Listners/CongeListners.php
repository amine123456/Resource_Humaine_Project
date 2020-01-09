<?php

namespace App\Listners;

use App\Events\Conge;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CongeListners
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
     * @param  Conge  $event
     * @return void
     */
    public function handle(Conge $event)
    {
        //
    }
}
