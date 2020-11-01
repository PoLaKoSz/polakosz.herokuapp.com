<?php

namespace Tests\Unit\Http\Controllers;

use App\User;
use App\Http\Middleware\MinifySourceCode;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tests\TestCase;

class MinifySourceCodeTest extends TestCase
{
    private static $middleware;

    public static function setUpBeforeClass() : void
    {
        self::$middleware = new MinifySourceCode();
    }

    public function testHandleRemoveHtmlComments()
    {
        config(['app.env' => 'production']);

        $request = Request::create('/dummy', 'GET');

        $response = self::$middleware->handle($request, function ($request) {
            $resp = new Response();
            $resp->setContent('<html><!-- hi --></html>');
            return $resp;
        });

        $this->assertEquals('<html></html>', $response->getOriginalContent());
    }

    public function testHandleWillNotChangeResponseInsidePreTags()
    {
        $request = Request::create('/dummy', 'GET');

        $response = self::$middleware->handle($request, function ($request) {
            $resp = new Response();
            $resp->setContent('<pre>  </pre>');
            return $resp;
        });

        $this->assertEquals('<pre>  </pre>', $response->getOriginalContent());
    }
}
