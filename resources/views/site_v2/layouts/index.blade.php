<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{$page->title[App::getLocale() ?? 'ar'] ?? ''}}</title>

    @include('site_v2.layouts.tags')

    @include('site_v2.layouts.styles')

    @stack('styles')

    <style>
        html{scroll-behavior:smooth}::-webkit-scrollbar{width:7px;border-radius:10px}::-webkit-scrollbar-track{background:#f1f1f1}::-webkit-scrollbar-thumb{background:#2fb2a2}::-webkit-scrollbar-thumb:hover{background:#555}

        .mt-7 {
            margin-top: 7.5rem;
        }
    </style>

</head>

<body>
    @stack('stiky-navbar')
    <div class="container">
        @include('site_v2.layouts.navbar')
    </div>

    <div class="container bg-white">
        @yield('content')
    </div>

    @include('site_v2.layouts.footer')
    @include('site_v2.layouts.scripts')
    @stack('scripts')
</body>

</html>
