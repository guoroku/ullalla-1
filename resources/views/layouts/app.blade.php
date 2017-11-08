<!DOCTYPE html>
<html>
    <head>
        @include('partials._header')
    </head>
    <body>
        @include('partials._nav')
        @yield('content')
        @include('partials._footer')
    </body>
</html>