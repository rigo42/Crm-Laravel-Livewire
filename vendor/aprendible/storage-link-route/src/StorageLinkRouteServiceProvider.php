<?php

namespace Aprendible\StorageLinkRoute;

use Illuminate\Support\ServiceProvider;

class StorageLinkRouteServiceProvider extends ServiceProvider
{
    public function boot()
    {
         $this->loadRoutesFrom( __DIR__ . '/../' . 'routes/web.php');
    }
}
