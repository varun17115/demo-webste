<html>
    <head>
        @include('user.partial.header')
        @include('user.partial.style')
    </head>
    <body>
        @include('user.partial.navbar')
        @yield('content')
    </body>
    @include('user.partial.script')
    @include('user.partial.footer')
    @stack('script')
</html>