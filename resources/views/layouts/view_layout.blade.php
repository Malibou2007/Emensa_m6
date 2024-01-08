<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield("title")</title>
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
        @yield("Main")
    </div>
    <hr class="Trenner">
    <div class="Footer" id="Footer">
        @yield("Footer")
    </div>
</div>
</body>
</html>
