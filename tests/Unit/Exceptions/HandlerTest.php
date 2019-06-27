<?php

namespace Tests\Unit\Exceptions;

use Tests\TestCase;

class HandlerTest extends TestCase
{
    public function testRenderReturnJsonWhenRequestedAsJson()
    {
        $response = $this->json('GET', '/api/secret');

        $response->assertStatus(401);
        $this->assertEquals(['error' => 'Unauthenticated.'], $response->getOriginalContent());
    }
}
