<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HttpRequestTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test if home page is responding properly.
     *
     * @test
     */
    public function application_page_test()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Pick your favorite language');
    }

    /**
     * Check if database records are properly being retrieved.
     *
     * @test
     */
    public function display_repository_api_test()
    {
        $repositories = \App\Repository::all();
        foreach ($repositories as $repository) {
            $response = $this->json('GET', "/api/repository/{$repository->id}");
            $response->assertStatus(200);
            $response->assertJsonFragment([
                'full_name' => "{$repository->owner}/{$repository->name}",
                'url' => $repository->url,
                'stars' => $repository->stars,
                'forks' => $repository->forks
            ]);
        }
    }

    /**
     * Check if database properly uploadable.
     *
     * @test
     */
    public function load_fresh_data_to_database_api_test()
    {
        $response = $this->json('POST', '/api/load/');
        $response->assertStatus(200);
        $response->assertJson([
            'success' => 'All languages updated successfully,'
        ]);
    }

    /**
     * Check if database records are retrievable.
     *
     * @test
     */
    public function show_repositories_api_test()
    {
        $languages = \App\Language::all();
        foreach ($languages as $language) {
            $response = $this->post("/api/show/{$language->id}");
            $response->assertStatus(200);
            $response->assertSee("\"panel-content-{$language->id}\"");
        }
    }
}
