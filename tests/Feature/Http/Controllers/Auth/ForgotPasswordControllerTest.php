<?php

namespace Tests\Feature\Http\Controllers;

use App\Http\Middleware\MinifySourceCode;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class ForgotPasswordControllerTest extends TestCase
{
    public function testUnauthenticatedUserCanAccess()
    {
        $response = $this->withoutMiddleware(MinifySourceCode::class)
            ->post('password/email');

        $response->assertSessionHasErrors([
            'email',
        ]);
    }
}
