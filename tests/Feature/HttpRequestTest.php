<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Ixudra\Curl\Facades\Curl;
use App\Services\Tokenizer;
use App\Language;
use App\Repository;

class HttpRequestTest extends TestCase
{
    use DatabaseTransactions;

    const BASE_API_URL = 'http://127.0.0.1:8000'; // Base API URL to submit HTTP requests
    const API_URL = [                             // API URL's to test
        self::BASE_API_URL . '/api/languages' => 'get',
        self::BASE_API_URL . '/api/repositories/1' => 'get',
        self::BASE_API_URL . '/api/load' => 'post', // <= this may exceed server processing timeout
        self::BASE_API_URL . '/api/load/1' => 'post',
    ];

    /**
     * Test if home page is responding properly.
     *
     * @test
     */
    public function application_page_test()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Poppest');
        $response->assertSee('<div id="root"></div>'); // Key tag to initialize React application
    }

    /**
     * Check if API routes are properly refusing requests with HTTP status 403
     *
     * @test
     */
    public function api_route_denied_status_test()
    {
        foreach (self::API_URL as $url => $method) {
            $response = call_user_func([$this, $method], $url);
            $response->assertStatus(403);
        }
    }

    /**
     * Check if API routes are properly accepting requests
     *
     * @test
     */
    public function api_route_accepted_test()
    {
        $token = new Tokenizer(time());
        foreach (self::API_URL as $url => $method) {
            $response = call_user_func([
                Curl::to($url)->withHeaders([
                    "X-TIMESTAMP: {$token->getTimestamp()}",
                    "X-TOKEN: {$token->getToken()}",
                ])->returnResponseObject(),
                $method
            ]);
            $this->assertEquals(200, $response->status);
        }
    }

    /**
     * Check if API routes are properly refusing requests and displaying the expected messages
     *
     * @test
     */
    public function api_route_denied_message_test()
    {
        // Validate no-timestamp/no-token requests
        foreach (self::API_URL as $url => $method) {
            $response = json_decode(call_user_func([Curl::to($url), $method]), true);
            $this->assertEquals('Request does not contain the validation token', $response['error']);
        }

        // Validate expired requests
        $token = new Tokenizer(1000);
        foreach (self::API_URL as $url => $method) {
            $response = json_decode(call_user_func([
                Curl::to($url)->withHeaders([
                    "X-TIMESTAMP: {$token->getTimestamp()}",
                    "X-TOKEN: {$token->getToken()}",
                ]),
                $method
            ]), true);
            $this->assertEquals('Token has expired', $response['error']);
        }

        // Validate erroneous tokens
        $token = new Tokenizer(time(), 'any-erroneous-token');
        foreach (self::API_URL as $url => $method) {
            $response = json_decode(call_user_func([
                Curl::to($url)->withHeaders([
                    "X-TIMESTAMP: {$token->getTimestamp()}",
                    "X-TOKEN: {$token->getToken()}",
                ]),
                $method
            ]), true);
            $this->assertEquals('Token is invalid', $response['error']);
        }
    }

    /**
     * Check if database properly uploadable.
     *
     * @test
     */
    public function load_fresh_data_to_database_api_test()
    {
        // Validate the update of a single language
        $lang = 1;
        $token = new Tokenizer(time());
        $response = json_decode(Curl::to(self::BASE_API_URL . "/api/load/{$lang}")
            ->withHeaders([
                "X-TIMESTAMP: {$token->getTimestamp()}",
                "X-TOKEN: {$token->getToken()}",
            ])
            ->post(),
        true);
        $this->assertEquals("Languages #{$lang} updated successfully", $response['success']);

        // Validate the update of all languages
        $response = json_decode(Curl::to(self::BASE_API_URL . '/api/load')
            ->withHeaders([
                "X-TIMESTAMP: {$token->getTimestamp()}",
                "X-TOKEN: {$token->getToken()}",
            ])
            ->post(),
        true);
        $this->assertEquals('All languages updated successfully', $response['success']);
    }
}
