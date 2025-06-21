<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index(){

        return view('components.dashboard');
    }

    public function fetchSpotifyUser(){

        // Check if the user is authenticated
        $token = session('spotify_token');
        if (!$token) {
            return response()->json(['error' => 'No token found'], 401);
        }
        
        // Retrieve the user information from the session
        $userprofile = Http::withToken($token)
            ->get('https://api.spotify.com/v1/me');
        if(!$userprofile){
            return response()->json(['error' => 'Failed to retrieve user profile from Spotify'], 500);
        }
        
        return response()->json([
            'userprofile' => $userprofile->json()
        ], 200);
    }
}
