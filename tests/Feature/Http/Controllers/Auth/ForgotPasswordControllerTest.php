<?php

namespace Tests\Feature\Http\Controllers\Auth;

use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class ForgotPasswordControllerTest extends TestCase
{
    public function testUnauthenticatedUserCanAccess()
    {
        $response = $this->post('password/email');

        $response->assertSessionHasErrors([
            'email',
        ]);
    }
}
