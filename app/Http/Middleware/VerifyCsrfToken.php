<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Cookie;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        '/login',
        '/logout',
        '/upload-image'
    ];


    protected function addCookieToResponse($request, $response)
    {
        $config = config('session');

        $response->headers->setCookie(
            new Cookie(
                'XSRF-TOKEN', $request->session()->token(), $this->availableAt(60 * $config['lifetime']),
                $config['path'], $config['domain'], $config['secure'], false, false, $config['same_site'] ?? null
            )
        );

        return $response;
    }
}
