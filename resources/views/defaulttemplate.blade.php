<!DOCTYPE html>
@include('includes.header')
<html lang="en-gb">
    <body class="container">
        @include('includes.navbar')

        @yield('content')

        @include('includes.footer')
    </body>
</html>
