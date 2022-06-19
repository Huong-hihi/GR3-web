<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Music</title>

    <link rel="shortcut icon" href="{{ asset('./assets/img/Images/logo-foursquare.svg') }}">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('./assets/component.css') }}">
    <link rel="stylesheet" href="{{ asset('./assets/style.css') }}">
    <link rel="stylesheet" href="{{ asset('./assets/grid.css') }}">
    <link rel="stylesheet" href="{{ asset('./css/audio.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/plyr/plyr.css') }}">

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Monoton&family=Open+Sans:ital,wght@0,400;1,300&family=Playfair+Display:wght@400;700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700&family=Shizuru&display=swap" rel="stylesheet">

    <!-- LINK CAROUSEL -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

    <!-- BOX ICON  -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>
<body>
<?php
    $user = \Illuminate\Support\Facades\Auth::user();
?>
<div style="display: none" class="master-data"
data-user-id="{{ $user->id ?? 'null' }}"
>

</div>
<div class="progress-bar" id="progress-bar">
    <a href="#" id="progress-val">
        <ion-icon name="logo-foursquare"></ion-icon>
    </a>
</div>
@include('client.layouts.header')

{{--@include('client.layouts.nav')--}}

@yield('content')

@include('client.layouts.footer')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html5media/1.1.8/html5media.min.js"></script>
<script src="{{ asset('libs/plyr/plyr.js') }}"></script>
<script src="{{ asset('main.js') }}"></script>
<script>
    let userId = $('.master-data').attr('data-user-id') != 'null' ? $('.master-data').attr('data-user-id') : false;
</script>
@yield('script')

</body>
</html>
