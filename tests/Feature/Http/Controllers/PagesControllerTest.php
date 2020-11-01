<?php

namespace Tests\Feature\Http\Controllers;

use App\Http\Middleware\MinifySourceCode;
use Tests\TestCase;

class PagesControllerTest extends TestCase
{
    public function testIndexReturnData()
    {
        $response = $this->withoutMiddleware(MinifySourceCode::class)
            ->get('/');

        $response
            ->assertStatus(200)
            ->assertViewHas('movies');
    }
}
