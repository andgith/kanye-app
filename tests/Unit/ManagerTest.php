<?php

namespace Tests\Unit;

use Exception;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Stubs\BarDriver;
use Tests\Unit\Stubs\FooDriver;
use Tests\Unit\Stubs\TestManager;

class ManagerTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_instantiate_driver(): void
    {
        $manager = new TestManager();

        $driver = $manager->driver('foo');

        $this->assertInstanceOf(FooDriver::class, $driver);
    }

    /**
     * @test
     */
    public function it_can_instantiate_default_driver(): void
    {
        $manager = new TestManager();

        $driver = $manager->driver();

        $this->assertInstanceOf(BarDriver::class, $driver);
    }

    /**
     * @test
     */
    public function it_can_call_a_method_of_a_driver(): void
    {
        $manager = new TestManager();

        $doAnything = $manager->motivate();

        $this->assertSame(
            "Believe you can, and you're halfway there.",
            $doAnything
        );
    }

    /**
     * @test
     */
    public function it_returns_an_exception_if_the_driver_is_invalid(): void
    {
        $manager = new TestManager();

        $this->expectException(Exception::class);

        $manager->driver('invalidDriver');
    }
}
