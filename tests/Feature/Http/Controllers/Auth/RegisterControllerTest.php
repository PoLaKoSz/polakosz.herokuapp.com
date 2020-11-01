<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    public function testGetRequestReturnCorrectView()
    {
        $response = $this->get('register');

        $response
            ->assertStatus(200)
            ->assertViewIs('auth.register');
    }

    public function testRegistrationCurrentlyDisabled()
    {
        $response = $this->json('GET', 'register');

        $this->assertStringContainsString('<p class="alert alert-info">A regisztráció jelenleg le van zárva.</p>', $response->getContent());
    }
}
