{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/assets/styles/app.scss', 'resources/assets/scripts/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('admin.layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html> --}}
<!-- resources/views/layouts/app.blade.php -->
 
{{-- <html>
    <head>
        <title>App Name - @yield('title')</title>
        @vite(['resources/assets/styles/app.scss', 'resources/assets/scripts/app.js'])
    </head>
    <body>
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  @include('components.head')
  <body>
  @include('components.loading')
  <div id="wrapper" class="wrapper has-animation">
    @include('components.header')
    <main id="main-content">
      @yield('content')
    </main>
    @include('components.footer')
    @include('components.javascript')
    </div>
  </body>
</html> --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  @include('components.head')
  <body>
  @include('components.loading')
  <div id="wrapper" class="wrapper has-animation">
    @include('components.header')
    <main id="main-content">
      @yield('content')
    </main>
    @include('components.footer')
    </div>
  </body>
</html>
