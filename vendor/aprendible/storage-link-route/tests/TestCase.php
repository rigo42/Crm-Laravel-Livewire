<?php

namespace Aprendible\StorageLinkRoute\Tests;

use Aprendible\StorageLinkRoute\StorageLinkRouteServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [StorageLinkRouteServiceProvider::class];
    }
}
