<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;

class AboutMeControllerTest extends TestCase
{
    public function testIndexReturnCorrectView()
    {
        $response = $this->get('/about-me');

        $response
            ->assertStatus(200)
            ->assertViewIs('pages.about-me');
    }
}
