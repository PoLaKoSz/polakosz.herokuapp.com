<?php

namespace Tests\Feature\Http\Controllers\Auth;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testUnauthenticatedUserCanAccess()
    {
        $response = $this->get('login');

        $response
            ->assertStatus(200)
            ->assertViewIs('auth.login');
    }

    public function testLogoutLogsOutUser()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->post('/logout');

        $response->assertRedirect('/hu');
    }
}
