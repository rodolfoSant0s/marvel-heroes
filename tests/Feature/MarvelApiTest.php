<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MarvelApiTest extends TestCase
{
    public function test_hero_by_id()
    {
        $response = $this->get('/api/v1/getHeroById/1009368');

        $response->assertStatus(200);
    }

    public function test_hero_by_name()
    {
        $response = $this->post('/api/v1/getHeroByName', ['name' => 'Iron Man']);

        $response->assertStatus(200);
    }
    
    public function test_hero_stories_by_id()
    {
        $response = $this->get('/api/v1/getStoriesByHeroId/1009368');

        $response->assertStatus(200);
    }    
}
