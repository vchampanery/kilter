<?php
// app/Facades/MyServiceFacade.php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class MyServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'widget-service'; // Replace with the service container key
    }
}
