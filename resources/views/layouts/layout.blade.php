<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield("title")</title>
    @vite('resources/css/emensa.css')
    @vite('resources/css/layout.css')
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
        <div class="Entrance" id="Entrance">
            @yield("Entrance")
        </div>
        <div class="Meals" id="Speisen">
            @yield("Meals")
        </div>
        <div class="Numbers" id="Numbers">
            @yield("Numbers")
        </div>
        <div class="Exit" id="Exit">
            @yield("Exit")
        </div>
        <div class="Direction" id="Direction">
            @yield("Direction")
        </div>
    </div>
    <hr class="Trenner">
    <div class="Footer" id="Footer">
        @yield("Footer")
    </div>
</div>
</body>
</html>
