<?php

namespace Tests\Feature\Http\Controllers;

use App\Http\Middleware\MinifySourceCode;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    public function testGetRequestReturnCorrectView()
    {
        $response = $this->withoutMiddleware(MinifySourceCode::class)
            ->get('register');

        $response
            ->assertStatus(200)
            ->assertViewIs('auth.register');
    }

    public function testRegistrationCurrentlyDisabled()
    {
        $response = $this->json('GET', 'register');

        $this->assertEquals('<p class="alert alert-info">A regisztráció jelenleg le van zárva.</p>', $response->getContent());
    }
}
