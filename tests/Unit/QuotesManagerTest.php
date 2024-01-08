<?php

namespace Tests\Unit;

use App\Managers\Quotes\KanyeQuotes;
use App\Managers\Quotes\QuotesManager;
use App\Managers\Quotes\RandomQuotes;
use PHPUnit\Framework\TestCase;

class QuotesManagerTest extends TestCase
{
    /** @test */
    public function it_can_create_kanye_quotes_driver()
    {
        $manager = new QuotesManager();
        $driver = $manager->createKanyeQuotesDriver();

        $this->assertInstanceOf(KanyeQuotes::class, $driver);
    }

    /** @test */
    public function it_can_create_random_quotes_driver()
    {
        $manager = new QuotesManager();
        $driver = $manager->createRandomQuotesDriver();

        $this->assertInstanceOf(RandomQuotes::class, $driver);
    }

    /** @test */
    public function it_can_create_default_quotes_driver()
    {
        $manager = new QuotesManager();
        $defaultDriver = $manager->getDefaultDriver();

        $this->assertEquals('kanyeQuotes', $defaultDriver);
    }
}
