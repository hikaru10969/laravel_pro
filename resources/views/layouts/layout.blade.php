<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>社員管理</title>
        @include('layouts.style-sheet')
    </head>
    <body>
        @include('layouts.nav')
        <div class='container py-4'>
            @yield('content')
        </div>
    </body>
</html>