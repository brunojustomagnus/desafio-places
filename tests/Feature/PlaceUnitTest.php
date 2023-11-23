<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Place;
use Illuminate\Http\Request;
class PlaceUnitTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_if_returns_status_200_in_this_route()
    {
        $response = $this->json('GET', '/api/places');
        $response->assertStatus(200);
    }
    public function test_place_required_name()
    {
        $data = [
            "name" => null,
            'slug' => 'testing-slug',
            'city' => 'random city',
            'state' => 'random state',
        ];
      
        $response =  $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->json('POST', '/api/place', $data);

        $response->assertStatus(422)->assertJson([
            "errors" => [
                "name" => ["The name field is required."]
            ]
        ]);
    }
    public function test_can_create_place()
    {
        $data = [
            "name" => "Random place",
            "slug" => "testing-slug-create",
            "city" => "random city",
            "state" => "random state",
        ];
        
        $response =  $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->json('POST', '/api/place', $data);

        $response->assertStatus(201)->assertJson([
            "name" => "Random place",
            "slug" => "testing-slug-create",
            "city" => "random city",
            "state" => "random state",
        ]);
    }
    public function test_can_update_place()
    {
        $data = [
            "name" => "New Random place",
            "slug" => "testing-slug-create",
            "city" => "random city",
            "state" => "random state",
        ];

        $response =  $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->json('PUT', '/api/place/2', $data);

        $response->assertStatus(200)->assertJson([
            "name" => "New Random place",
            "slug" => "testing-slug-create",
            "city" => "random city",
            "state" => "random state",
        ]);
    }
    public function test_can_delete_place()
    {
        $resp = [
            "message" => "Place deleted successfully",
        ];

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->json('DELETE', '/api/place/1');
    
        $response->assertStatus(200)
        ->assertJson($resp);
    }
}