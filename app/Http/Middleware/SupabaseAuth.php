<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SupabaseAuth
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('supabase_user')) {
            return redirect()->route('login')->withErrors([
                'message' => 'Please log in to access this page.'
            ]);
        }

        $user = Session::get('supabase_user');
        if ($user['role'] !== 'admin') {
            abort(403, 'Invalid email or password');
        }

        return $next($request);
    }
}
