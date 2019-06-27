<?php

namespace Tests\Feature\Http\Controllers;

use App\Http\Middleware\MinifySourceCode;
use Tests\TestCase;

class AboutMeControllerTest extends TestCase
{
    public function testIndexReturnCorrectView()
    {
        $response = $this->withoutMiddleware(MinifySourceCode::class)
            ->get('/about-me');

        $response
            ->assertStatus(200)
            ->assertViewIs('pages.about-me');
    }
}
