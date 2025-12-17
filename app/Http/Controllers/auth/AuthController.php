<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function LoginPage()
    {
        if (Session::has('supabase_user')) {
            return redirect()->route('admin.dashboard.page');
        }

        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $response = Http::withHeaders([
            'apikey'        => config('services.supabase.anon_key'),
            'Authorization' => 'Bearer ' . config('services.supabase.anon_key'),
            'Content-Type'  => 'application/json',
        ])->post(
            config('services.supabase.url') . '/auth/v1/token?grant_type=password',
            [
                'email'    => $request->email,
                'password' => $request->password,
            ]
        );

        if ($response->failed()) {
            return back()->withErrors([
                'email' => 'Invalid email or password',
            ]);
        }

        $data = $response->json();

        if (!isset($data['user']['id'])) {
            return back()->withErrors(['Authentication failed']);
        }

        $userId = $data['user']['id'];

        // Get profile
        $profile = DB::table('profiles')
            ->where('id', $userId)
            ->first();

        if (!$profile) {
            return back()->withErrors(['Profile not found']);
        }

        if ($profile->role !== 'admin') {
            return back()->withErrors(['Invalid email or password']);
        }

        Session::put('supabase_user', [
            'id'            => $userId,
            'email'         => $request->email,
            'role'          => $profile->role,
            'access_token'  => $data['access_token'],
            'refresh_token' => $data['refresh_token'],
        ]);

        return redirect()->route('admin.dashboard.page')
                         ->with('success', 'Logged in successfully!');
    }

    public function logout()
    {
        Session::forget('supabase_user');
        return redirect()->route('login')
                         ->with('success', 'Logged out successfully!');
    }
}

