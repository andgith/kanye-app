<?php

namespace App\Managers\Quotes;

interface QuoteDriverInterface {
    public function getQuotes($count = 5);
    public function refreshQuotes();
}
