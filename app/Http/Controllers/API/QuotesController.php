<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Managers\Quotes\QuotesManager;

class QuotesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return (new QuotesManager)->getQuotes();
    }

    /**
     * Display a refreshed listing of the resource.
     */
    public function refresh()
    {
        return (new QuotesManager)->refreshQuotes();
    }
}
