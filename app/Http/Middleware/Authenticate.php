<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    protected function redirectTo(Request $request): ?string
    {
        // If the request expects JSON (like an API request), do not redirect, just return null.
        if ($request->expectsJson()) {
            return null;
        }

        // Redirect to the login route if the user is not authenticated.
        return route('login');
    }
}
