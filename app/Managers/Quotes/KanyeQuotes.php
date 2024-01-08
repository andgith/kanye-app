<?php

namespace App\Managers\Quotes;

use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

/**
 * Class KanyeQuotes
 *
 * @package App\Managers\Quotes
 */
class KanyeQuotes implements QuoteDriverInterface
{
    /**
     * The base URL for the API.
     */
    private const BASE_URL = 'https://api.kanye.rest';

    /**
     * The cache key used to store and retrieve quotes from the cache.
     */
    private const CACHE_KEY = 'kanyeQuotes';

    /**
     * Get a specified number of Kanye West quotes.
     *
     * @param int $count The number of quotes to retrieve. Default is 5.
     *
     * @return \Illuminate\Support\Collection Returns a collection of Kanye West quotes with 'quote' and 'author' keys.
     */
    public function getQuotes($count = 5)
    {
        return Cache::rememberForever(self::CACHE_KEY, function () use ($count) {
            return collect(
                Http::pool(
                    fn(Pool $pool) => collect(range(1, $count))->each(
                        function () use ($pool) {
                            $pool->get(self::BASE_URL . '/quote');
                        }
                    )
                )
            )->map(
                fn($response) => [
                    'quote' => $response->throw()->json('quote'),
                    'author' => 'Kanye West',
                ]
            );
        });
    }

    /**
     * Refresh the cached Kanye West quotes by forgetting the current cache entry.
     *
     * @return \Illuminate\Support\Collection Returns a refreshed collection of Kanye West quotes.
     */
    public function refreshQuotes()
    {
        Cache::forget(self::CACHE_KEY);

        return $this->getQuotes();
    }
}
