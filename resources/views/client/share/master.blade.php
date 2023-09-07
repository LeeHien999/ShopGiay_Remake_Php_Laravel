<!DOCTYPE HTML>
<html>
    @include('client.share.css')
    <body>
        <div class="colorlib-loader"></div>
        <div>
            @include('client.share.nav')
            @yield('noi_dung')
            @include('client.share.partner')
        </div>
        @include('client.share.footer')
        @include('client.share.js')
        @yield('js')
    </body>
</html>
