<?php

namespace Tests\Feature\Http\Controllers;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexViewWhenUserAuthenticated()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get('/home');

        $response
            ->assertStatus(200)
            ->assertViewIs('home');
    }

    public function testIndexRedirectWhenUserNotAuthenticated()
    {
        $response = $this->get('/home');

        $response->assertStatus(302);
    }
}
