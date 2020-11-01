<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;

class PagesControllerTest extends TestCase
{
    public function testIndexReturnData()
    {
        $response = $this->get('/');

        $response
            ->assertStatus(200)
            ->assertViewHas('movies');
    }
}
