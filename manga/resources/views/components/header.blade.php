<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>new project</title>
    @vite('resources/css/app.css')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <h2>
                    logo
                </h2>
            </div>
            <ul>
                <li><a href="{{ url('/') }}">home</a></li>
                <li><a href="{{ url('/community') }}">community</a></li>
                <li><a href="{{ url('/manga') }}">manga</a></li>
                <li><a href="{{ url('/contact') }}">contact</a></li>
            </ul>
            @if(Auth::check())
                <div class="buttons">
                    <span></span>
                    <a href="{{ url('dashboard') }}">{{ Auth::user()->name }}</a>
                </div>
            @else
                <div class="buttons">
                    <span></span>
                    <a href="{{ url('login') }}">Log In</a>
                    <a href="{{ url('register') }}">Sign Up</a>
                </div>
            @endif

        </nav>
    </header>