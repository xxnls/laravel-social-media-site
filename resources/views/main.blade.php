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
</head>
<body class="bg-light">

    {{-- Top Bar --}}
    @include('partials._topbar')

    <div class="container-fluid p-0">
        <div class="row no-gutters m-0">
            {{-- Left Navigation --}}
            @auth
            @include('partials._leftnav')
            @else
            {{-- Spacer --}}
            <div class="col-md-2"></div>
            @endauth
    
            {{-- Spacer --}}
            <div class="col-md-1"></div>
            
            {{-- Content --}}
            <div class="col-md-6">
                <div class="p-3">
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
</body>
</html>