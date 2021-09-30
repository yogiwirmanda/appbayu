<!DOCTYPE html>
<html>
<head>
    @include('master.head')
</head>
<body class="g-sidenav-show g-sidenav-pinned">
    @include('master.sidenav')
    <div class="main-content" id="panel">
        @include('master.topnav')
        @include('master.header')
        @yield('content')
    </div>
</body>
@include('master.script')
</html>