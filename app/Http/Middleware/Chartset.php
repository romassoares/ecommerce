<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Chartset
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        $contentType = $response->headers->get('Content-Type');
        if (!empty($contentType)) {
            $response->header('Content-Type', str_replace('UTF-8', 'iso-8859-1', $contentType));
        }
        return $response;
    }
}
