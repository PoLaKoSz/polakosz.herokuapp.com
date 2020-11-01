<?php

namespace Tests\Unit\Http\Controllers;

use App\User;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Http\Request;
use Tests\TestCase;

class RedirectIfAuthenticatedTest extends TestCase
{
    private static $middleware;

    public static function setUpBeforeClass() : void
    {
        self::$middleware = new RedirectIfAuthenticated();
    }

    public function testHandleDoNothingWhenUserNotAuthenticated()
    {
        $request = Request::create('/login', 'GET');

        $response = self::$middleware->handle($request, function () {
        });

        $this->assertNull($response);
    }

    public function testHandleRedirectToHomeWhenUserAlreadyAuthenticated()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $request = Request::create('/login', 'GET');

        $response = self::$middleware->handle($request, function () {
        });

        $this->assertEquals(302, $response->status());
    }
}
