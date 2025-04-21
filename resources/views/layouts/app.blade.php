<!DOCTYPE html>
<html>
    <head>
        @include('layouts.components.head')
        @include('layouts.assets.css')
    </head>
    <body>
        <div class="loader-wrapper">
            <div class="loader-index">
                <span></span>
            </div>
            <svg>
                <defs></defs>
                <filter id="goo">
                    <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
                    <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"> </fecolormatrix>
                </filter>
            </svg>
        </div>
        <div class="tap-top">
            <i data-feather="chevrons-up"></i>
        </div>
        <div class="page-wrapper compact-wrapper" id="pageWrapper">
            @include('layouts.components.header')
            <div class="page-body-wrapper horizontal-menu">
                @include('layouts.components.sidebar')
                <main class="page-body">
                    <div class="container-fluid">
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div class="d-flex align-items-center">
                                        @yield('breadcrumb-title')
                                        @section('modals')
                                            @yield('modals')
                                        @show
                                    </div>
                                </div>
                                <div class="col-6">
                                    <x-breadcrumb>
                                        @yield('breadcrumb-items')
                                    </x-breadcrumb>
                                </div>
                            </div>
                        </div>
                        {{ $slot }}
                    </div>
                </main>
                @include('layouts.components.footer')
            </div>
        </div>
        @include('layouts.assets.scripts')
    </body>
</html>
