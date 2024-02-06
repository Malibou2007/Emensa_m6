<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield("title")</title>
    @vite('resources/css/layout.css')
    @vite(['resources/css/auth.css'])
</head>
<body>
<div class="Page">
    <div class="Header">
        <div class="Logo">
            @yield("Logo")
        </div>
        <div class="Navigation">
            @yield("Navigation")
        </div>
        <div class="Login">
            @yield("Login")
        </div>
    </div>
    <hr class="Trenner">
    <div class="Main">
        @yield("Main")
    </div>
    <div class="Bewertungen">
        @yield("Bewertungen")
    </div>
    <div class="content">
        @yield("content")
    </div>
    <hr class="Trenner">
    <div class="Footer" id="Footer">
        @yield("Footer")
    </div>
</div>
</body>
</html>
