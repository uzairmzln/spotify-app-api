<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite(['resources/css/login.css', 'resources/js/app.js'])
</head>
<body class="body">
    <video autoplay muted loop id="myVideo">
        <source src="{{asset('video/bg-1.mp4')}}" type="video/mp4">
    </video>
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-6 text-center">
                <div class="container">
                    <img src="{{asset('images/UM-removebg-preview.png')}}" alt="" class="logo img-fluid mb-4">
                    <img src="{{asset('images/spotify_green.png')}}" alt="" class="logo img-fluid mb-4">
                </div>
                <h1 class="t-head mb-4"><span class="d-block p-2">Welcome to</span> <span class="d-block">Spoti-Wrap Gallery</span></h1>
            </div>
            <div class="col-md-6">
                <div class="login-c container">
                    <div class="login-c-2 d-flex flex-column align-items-center">
                        <div class="text-center">
                            <img src="{{asset('images/spotify_white.png')}}" alt="" class="logo-2 img-fluid mb-4">
                            <p class="t-head h1">music for everyone</p>
                        </div>
                        <div class="form-group m-5">
                            <a href="{{ url('/auth/spotify') }}" class="btn btn-spotify fw-bold">Login With Spotify</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>