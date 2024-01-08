<?php

namespace Tests\Unit\Stubs;

use App\Managers\Manager;

class TestManager extends Manager
{
    public function createBarDriver()
    {
        return new BarDriver();
    }

    public function createFooDriver()
    {
        return new FooDriver();
    }

    public function getDefaultDriver(): string
    {
        return 'bar';
    }
}
