<?php

namespace App\Managers\Quotes;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class RandomQuotes implements QuoteDriverInterface
{
    /**
     * The base URL for the API.
     */
    const BASE_URL = 'https://api.quotable.io';

    /**
     * The cache key used to store and retrieve quotes from the cache.
     */
    private const CACHE_KEY = 'randomQuotes';

    /**
     * Get a specified number of random quotes.
     *
     * @param int $count The number of quotes to retrieve. Default is 5.
     *
     * @return \Illuminate\Support\Collection Returns a collection of quotes with 'quote' and 'author' keys.
     */
    public function getQuotes($count = 5)
    {
        return Cache::rememberForever(self::CACHE_KEY, function () use ($count) {
            return Http::get(self::BASE_URL . '/quotes/random', ['limit' => $count])
                ->throw()
                ->collect()
                ->map(
                    fn($quote) => [
                        'quote' => $quote['content'],
                        'author' => $quote['author'],
                    ]
                );
        });
    }

    /**
     * Refresh the cached random quotes by forgetting the current cache entry.
     *
     * @return \Illuminate\Support\Collection Returns a refreshed collection of random quotes.
     */
    public function refreshQuotes()
    {
        Cache::forget(self::CACHE_KEY);

        return $this->getQuotes();
    }
}
