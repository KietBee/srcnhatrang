<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0"/> -->
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=1"/>
  <meta name="description" content="Connect & Grow Your Business with the Power of the Encompass Platform">
  <link rel="icon" href="" type="image/x-icon">
  <link rel="apple-touch-icon" sizes="180x180" href="">
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
  @vite(['resources/css/admin.scss', 'resources/js/admin.js'])
  <script>
    function toggleDarkMode() {
      var htmlElement = document.querySelector('html');
      htmlElement.classList.toggle('dark');
    }

                   // Kiểm tra xem trạng thái dark mode đã được lưu trong Local Storage chưa
    if (localStorage.getItem('darkMode') === 'true') {
    // Nếu có, thêm lớp 'dark' vào thẻ html
    document.documentElement.classList.add('dark');
    }

    // Hàm để toggle trạng thái dark mode và lưu vào Local Storage
    function toggleDarkMode() {
    var htmlElement = document.documentElement;
    var isDarkMode = htmlElement.classList.toggle('dark');
    
    // Lưu trạng thái dark mode vào Local Storage
    localStorage.setItem('darkMode', isDarkMode);
    }

    // Kiểm tra sự kiện khi trang được tải
    window.onload = function() {
    // Kiểm tra trạng thái dark mode lưu trong Local Storage
    if (localStorage.getItem('darkMode') === 'true') {
       // Nếu có, thêm lớp 'dark' vào thẻ html
       document.documentElement.classList.add('dark');
    }
    };

 </script>
</head>
