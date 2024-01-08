<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class RefreshQuotesTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config(['app.api_key' => 'test-key']);
    }

    /** @test */
    public function it_can_get_random_quotes()
    {
        Http::fake();

        $this->get(route('api.quotes.refresh'), ['x-api-key' => 'test-key'])
            ->assertOk();
    }

    /** @test */
    public function it_authenticates_with_api_key()
    {
        $this->get(route('api.quotes.refresh'), [
            'x-api-key' => 'incorrect-key',
        ])->assertUnauthorized();
    }
}
