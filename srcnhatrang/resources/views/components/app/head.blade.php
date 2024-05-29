<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0"/> -->
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=1"/>
  <meta name="description" content="Connect & Grow Your Business with the Power of the Encompass Platform">
  <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('apple-icon-57x57.png') }}">
  <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('apple-icon-60x60.png') }}">
  <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('apple-icon-72x72.png') }}">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('apple-icon-76x76.png') }}">
  <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('apple-icon-114x114.png') }}">
  <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('apple-icon-120x120.png') }}">
  <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('apple-icon-144x144.png') }}">
  <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('apple-icon-152x152.png') }}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-icon-180x180.png') }}">
  <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('android-icon-192x192.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon-96x96.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
  <link rel="manifest" href="{{ asset('manifest.json') }}">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="{{ asset('ms-icon-144x144.png') }}">
  <meta name="theme-color" content="#ffffff">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-touch-fullscreen" content="yes">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta property="og:image" content="@asset('images/the_latest/the_latest_image.png')">
  <meta property="og:image:type" content="image/png">
  <meta property="og:image:height" content="228">
  <meta property="og:description" content="Connect & Grow Your Business with the Power of the Encompass Platform.">
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
  <link rel="canonical" href="http://sagethem.vm/"/>
  <link href="https://fonts.googleapis.com" rel="dns-prefetch" crossorigin>
  <link href="https://fonts.googleapis.com" rel="preconnect" crossorigin>
  <link href="https://cdnjs.cloudflare.com" rel="dns-prefetch" crossorigin>
  <link href="https://cdnjs.cloudflare.com" rel="preconnect" crossorigin>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" rel="preload" as="script">
  <link href='resources/assets/scripts/app-mobile.js' media="(max-width: 991px)" rel="preload" as="script">
  <link href='resources/assets/scripts/app-desktop.js' media="(min-width: 992px)" rel="preload" as="script">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link rel="stylesheet" id="sage/font-css" onload="if(media!='screen')media='screen'" href='@asset("styles/print.scss")' type="text/css" media="print" />
  @vite(['resources/css/app.scss', 'resources/js/app.js'])
  @livewireStyles
</head>
