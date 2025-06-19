<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', function () {
    return view('login');
});

Route::get('/auth/spotify', function () {
    return socialite::driver('spotify')
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
    dd($user);
});