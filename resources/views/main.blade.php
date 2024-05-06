<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        {{$pageTitle??"Home"}}
    </title>
    <link rel="stylesheet" href="{{mix('/node_modules/bootstrap/dist/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{mix('/node_modules/bootstrap-icons/font/bootstrap-icons.min.css')}}" />
    <link rel="stylesheet" href="{{mix('/node_modules/simplebar/dist/simplebar.css')}}" />

</head>
<body class="bg-light" data-simplebar>

    {{-- Top Bar --}}
    @include('partials._topbar')

    <div class="container-fluid p-0 my-5">
        <div class="row no-gutters m-0">
            {{-- Left Navigation (only when logged in) --}}
            @auth
                @include('partials._leftnav')
            @endauth
    
            {{-- Spacer --}}
            <div class="col-md-3"></div>
            
            {{-- Content --}}
            <div class="col-md-6">
                <div class="p-3">
                    <x-flash-message />
                    @yield('content')
                </div>
            </div>
    
            {{-- Spacer --}}
            <div class="col-md-1"></div>
    
            {{-- Right Navigation --}}
            {{-- @include('partials._rightnav') --}}
        </div>
    </div>

    {{-- Footer --}}
    @include('partials._footer')

    <script src="{{mix('/node_modules/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{mix('/node_modules/@popperjs/core/dist/umd/popper.min.js')}}"></script>
    <script src="{{mix('/node_modules/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{mix('/node_modules/simplebar/dist/simplebar.min.js')}}"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
</body>
</html>