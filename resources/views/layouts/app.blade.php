<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.partial.head')
</head>
<body>
@include("layouts.partial.sidebar")

<div class="wrapper d-flex flex-column min-vh-100 bg-light">
    {{-- kapalo --}}
    @include('layouts.partial.header')

    {{-- badan --}}
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            @yield('content')
        </div>
    </div>

    {{-- kaki kaki --}}
    <footer class="footer">
        <div><a href="https://coreui.io">CoreUI </a><a href="https://coreui.io">Bootstrap Admin Template</a> &copy; 2021 creativeLabs.</div>
        <div class="ms-auto">Powered by&nbsp;<a href="https://coreui.io/bootstrap/ui-components/">CoreUI UI Components</a></div>
    </footer>
</div>
<script src="{{ asset('js/app.js') }}"   crossorigin="anonymous"></script>
<script src="https://unpkg.com/simplebar@5.3.6/dist/simplebar.min.js"></script>
@yield('script')
</body>
</html>
<body>

</body>

