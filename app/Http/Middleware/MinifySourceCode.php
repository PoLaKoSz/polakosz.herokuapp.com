<?php

namespace App\Http\Middleware;

use Closure;

class MinifySourceCode
{
    /**
     * Handle an incoming request.
     * https://stackoverflow.com/a/37510913/7306734
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $buffer   = $response->getContent();

        if (strpos($buffer, '<pre>') !== false) {
            $replace = [
                '/<!--[^\[](.*?)[^\]]-->/s' => '',
                "/<\?php/"                  => '<?php ',
                "/\r/"                      => '',
                "/>\n</"                    => '><',
                "/>\s+\n</"                 => '><',
                "/>\n\s+</"                 => '><',
            ];
        } else {
            $replace = [
                '/<!--[^\[](.*?)[^\]]-->/s' => '',
                "/<\?php/"                  => '<?php ',
                "/\n([\S])/"                => '$1',
                "/\r/"                      => '',
                "/\n/"                      => '',
                "/\t/"                      => '',
                "/ +/"                      => ' ',
            ];
        }

        $buffer = preg_replace(array_keys($replace), array_values($replace), $buffer);

        $response->setContent($buffer);

        return $response;
    }
}
