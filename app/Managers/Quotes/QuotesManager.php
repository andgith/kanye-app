<?php

namespace App\Managers\Quotes;

use App\Managers\Manager;

class QuotesManager extends Manager {

    public function createKanyeQuotesDriver(): QuoteDriverInterface
    {
        return new KanyeQuotes();
    }

    public function createRandomQuotesDriver(): QuoteDriverInterface
    {
        return new RandomQuotes();
    }

    public function getDefaultDriver(): string
    {
        return 'kanyeQuotes';
    }
}
