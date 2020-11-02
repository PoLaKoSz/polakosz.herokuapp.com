<?php

namespace Tests\Feature\Http\Controllers\Auth;

use Tests\TestCase;

class ResetPasswordControllerTest extends TestCase
{
    public function testReturnCorrectView()
    {
        $token = 'asdasd';
        $response = $this->get("password/reset/$token");

        $response
            ->assertStatus(200)
            ->assertViewIs('auth.passwords.reset');
    }
}
