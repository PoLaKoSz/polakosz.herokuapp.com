<?php

namespace Tests\Feature\Http\Controllers;

use App\Http\Middleware\MinifySourceCode;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
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
