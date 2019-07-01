<?php

namespace Tests\Feature\Http\Controllers;

use App\User;
use App\Http\Middleware\MinifySourceCode;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    public function testUnauthenticatedUserCanAccess()
    {
        $response = $this->withoutMiddleware(MinifySourceCode::class)
            ->get('login');

        $response
            ->assertStatus(200)
            ->assertViewIs('auth.login');
    }

    public function testLogoutLogsOutUser()
    {
        $user = factory(User::class)->create();

        $response = $this->withoutMiddleware(MinifySourceCode::class)
            ->actingAs($user)
            ->post('/logout');

        $response->assertRedirect('/hu');
    }
}