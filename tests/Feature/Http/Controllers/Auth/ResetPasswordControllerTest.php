<?php

namespace Tests\Feature\Http\Controllers;

use App\Http\Middleware\MinifySourceCode;
use Tests\TestCase;

class ResetPasswordControllerTest extends TestCase
{
    public function testReturnCorrectView()
    {
        $token = 'asdasd';
        $response = $this->withoutMiddleware(MinifySourceCode::class)
            ->get('password/reset/' . $token);

        $response
            ->assertStatus(200)
            ->assertViewIs('auth.passwords.reset');
    }
}
