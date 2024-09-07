<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('page_title')</title>
    @include('layouts.components.link')
</head>
<body>
    <div id="wrapper">
       @include('layouts.components.nav')
        <div id="page-wrapper" class="gray-bg dashbard-1">
            {{-- top menu --}}
            @include('layouts.topmenu')      
            <div class="row">
                <div class="col-lg-12">
                    <div class="wrapper wrapper-content">
                            <div class="row">
                                
                                @yield('content')
                            </div>
                          
                    </div>
                    {{-- footer --}}
                    @include('layouts.footer')
                </div>
            </div>

        </div>
           
        @include('layouts.components.right-sidebar')
    </div>

    @include('layouts.components.scirpts')
    @stack('scripts')
</body>
</html>