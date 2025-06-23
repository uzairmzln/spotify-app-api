<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('login');
});

Route::get('/auth/spotify', function () {
    return Socialite::driver('spotify')
        ->scopes([
            'user-read-email',
            'playlist-read-private',
            'playlist-modify-public',
            'playlist-modify-private',
            'user-library-read',
            'user-library-modify',
            'user-top-read',
            'user-read-recently-played',
            'user-follow-read',
            'user-follow-modify'
        ])
        ->redirect();
});

Route::get('/auth/spotify/callback', function () {
    $user = Socialite::driver('spotify')->user();
    
    session([
        'spotify_token' => $user->token,
        'spotify_refresh_token' => $user->refreshToken,
        'spotify_expires_in' => $user->expiresIn,
        'spotify_user' => $user
    ]);
    
    return redirect('/dashboard');
});

Route::get('/spotify-user', [DashboardController::class, 'fetchSpotifyApi']);
Route::get('/dashboard', [DashboardController::class, 'index']);
// Route::get('/auth/spotify/callback', function () {
//     $user = Socialite::driver('spotify')->user();
//     dd($user);
// });

// Route::get('/dashboard', function () {
//     return view('components.dashboard');
// });