<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use App\Managers\Quotes\QuotesManager;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RandomQuotesTest extends TestCase
{
    /** @test */
    public function it_can_get_fetch_random_quotes()
    {
        Http::fake(fn() => $this->getQuotes());

        $quotes = (new QuotesManager())->driver('randomQuotes')->getQuotes();

        $this->assertCount(5, $quotes);
    }

    /** @test */
    public function it_caches_quotes()
    {
        Http::fake(fn() => $this->getQuotes());

        $quotes1 = (new QuotesManager())->driver('randomQuotes')->getQuotes();
        $quotes2 = (new QuotesManager())->driver('randomQuotes')->getQuotes();

        $this->assertSame($quotes1, $quotes2);
    }

    /** @test */
    public function it_can_refresh_quotes()
    {
        Http::fake(fn() => $this->getQuotes());

        $quotes1 = (new QuotesManager())->driver('randomQuotes')->getQuotes();
        $refreshQuotes = (new QuotesManager())
            ->driver('randomQuotes')
            ->refreshQuotes();
        $quotes2 = (new QuotesManager())
            ->driver('randomQuotes')
            ->refreshQuotes();

        $this->assertNotSame($quotes1, $quotes2);
    }

    function getQuotes(): array
    {
        return [
            [
                'content' =>
                    'The only way to do great work is to love what you do.',
                'author' => 'Steve Jobs',
            ],
            [
                'content' =>
                    "In three words I can sum up everything I've learned about life: it goes on.",
                'author' => 'Robert Frost',
            ],
            [
                'content' => "Believe you can and you're halfway there.",
                'author' => 'Theodore Roosevelt',
            ],
            [
                'content' =>
                    'The future belongs to those who believe in the beauty of their dreams.',
                'author' => 'Eleanor Roosevelt',
            ],
            [
                'content' =>
                    'Success is not final, failure is not fatal: It is the courage to continue that counts.',
                'author' => 'Winston Churchill',
            ],
        ];
    }
}
