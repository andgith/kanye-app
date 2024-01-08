<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use App\Managers\Quotes\QuotesManager;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KanyeQuotesTest extends TestCase
{
    /** @test */
    public function it_can_get_fetch_random_quotes()
    {
        Http::fake(fn () => ['quote' => $this->getRandomQuote()]);

        $quotes = (new QuotesManager())->driver('kanyeQuotes')->getQuotes();

        $this->assertCount(5, $quotes);
    }

    /** @test */
    public function it_caches_quotes()
    {
        Http::fake(fn () => ['quote' => $this->getRandomQuote()]);

        $quotes1 = (new QuotesManager())->driver('kanyeQuotes')->getQuotes();
        $quotes2 = (new QuotesManager())->driver('kanyeQuotes')->getQuotes();

        $this->assertSame($quotes1, $quotes2);
    }

    /** @test */
    public function it_can_refresh_quotes()
    {
        Http::fake(fn () => ['quote' => $this->getRandomQuote()]);

        $quotes1 = (new QuotesManager())->driver('kanyeQuotes')->getQuotes();
        $refreshQuotes = (new QuotesManager())->driver('kanyeQuotes')->refreshQuotes();
        $quotes2 = (new QuotesManager())->driver('kanyeQuotes')->refreshQuotes();

        $this->assertNotSame($quotes1, $quotes2);
    }

    function getRandomQuote(): array
    {
        $quotes = [
            ["quote" => "The only way to do great work is to love what you do. - Steve Jobs"],
            ["quote" => "In three words I can sum up everything I've learned about life: it goes on. - Robert Frost"],
            ["quote" => "Believe you can and you're halfway there. - Theodore Roosevelt"],
            ["quote" => "The future belongs to those who believe in the beauty of their dreams. - Eleanor Roosevelt"],
            ["quote" => "Success is not final, failure is not fatal: It is the courage to continue that counts. - Winston Churchill"]
        ];

        return $quotes[array_rand($quotes)];
    }
}
