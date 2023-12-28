<!doctype html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>{{ config('app.name') }} {{ config('system.title_divider_sign') }} @yield('title','Əsas səhifə')</title>
    <!-- CSS files -->
    <link href="{{ asset('back/tabler') }}/dist/css/tabler.min.css" rel="stylesheet"/>
    <link href="{{ asset('back/tabler') }}/dist/css/tabler-flags.min.css" rel="stylesheet"/>
    <link href="{{ asset('back/tabler') }}/dist/css/tabler-payments.min.css" rel="stylesheet"/>
    <link href="{{ asset('back/tabler') }}/dist/css/tabler-vendors.min.css" rel="stylesheet"/>
    <link href="{{ asset('back/tabler') }}/dist/css/demo.min.css" rel="stylesheet"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="{{ asset('back/css/main.css') }}">

    @yield('css')
</head>
<body >
<input type="hidden" value="{{ config('app.url') }}" id="rootUrl">
<div class="wrapper">
    @include('back.includes.parts.aside')

    @include('back.includes.parts.header')

    <div class="page-wrapper mt-3 col-md-10">
        <div class="col-md-12">
        @yield('content')
        </div>
    </div>
</div>
@include('back.includes.modals.report')
<script src="{{ asset('back/tabler') }}/dist/libs/apexcharts/dist/apexcharts.min.js"></script>
<script src="{{ asset('back/tabler') }}/dist/js/tabler.min.js"></script>
<script src="{{ asset('back/tabler') }}/dist/js/demo.min.js"></script>

<script src="{{ asset('back/js/main.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@yield('js')
</body>
</html>
