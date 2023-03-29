<!DOCTYPE html>
<html lang="en">
    @include('web.partials.head')
<body>
    {{-- Header --}}
    @include('web.partials.header')
    {{-- End Header --}}



    @yield('content')

    {{-- Footer --}}
    @include('web.partials.footer')
    {{-- End Footer --}}

    <a title="back to top" id="back-top"></a>
    <a title="back to top" id="back-top"></a>

    {{-- Script --}}
    @include('web.partials.script')
    {{-- End Script --}}
</body>
</html>