<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-template="vertical-menu-template-free"
>
<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />
    <title>System</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <meta name="description" content="" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet"
    />
    <link rel="canonical" href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/">
    <link rel="stylesheet" href="{{ cxl_asset('css/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ cxl_asset('css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ cxl_asset('css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ cxl_asset('css/demo.css') }}" />
    <link rel="stylesheet" href="{{ cxl_asset('css/perfect-scrollbar.css') }}" />
    <script src="{{ cxl_asset('js/helpers.js') }}"></script>
    <script src=" {{ cxl_asset('js/config.js') }}"></script>
    <link rel="stylesheet" href=@yield('style') />
</head>

<body @yield('body-attribute')>
    @yield('master')
    <script src="{{ cxl_asset('libs/jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ cxl_asset('libs/popper/popper.min.js') }}"></script>
    <script src="{{ cxl_asset('js/bootstrap.js') }}"></script>
    <script src="{{ cxl_asset('libs/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ cxl_asset('js/menu.js') }}"></script>
    <script src="{{ cxl_asset('js/main.js') }}"></script>
    <script src="{{ cxl_asset('js/dashboards-analytics.js') }}"></script>
    <script src="{{ cxl_asset('js/pages-account-settings-account.js') }}"></script>
    <script async defer src="{{ cxl_asset('js/buttons.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on('click', '#logout', function (e) {
                e.preventDefault();
                $('#logout-form').submit();
            })
        });
    </script>
    @yield('script')
</body>
</html>

