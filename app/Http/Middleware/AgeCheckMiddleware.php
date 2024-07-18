<?php

namespace App\Http\Middleware;

use Closure;

class AgeCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $age = $request->input('age');

        if ($age < 18) {
            return redirect()->back()->withErrors(['age' => 'You must be at least 18 years old to register.']);
        }

        return $next($request);
    }
}
