<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Str;

class ChangeJsonMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $output = $next($request);
        if ($output) {

            $json = $output->content();
            $modelAsArray = json_decode($json, true);

            if (is_array($modelAsArray)) {
                array_walk_recursive($modelAsArray, function (&$item, $key) {
                    $item = $item === null ? '-' : $item;
                });
                return response($modelAsArray);
            } else {
                return $next($request);
            }
        }
    }
}
