<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  @include('components.head')
  <body class="has-animation">
    @include('components.loading')
    <div id="wrapper" class="wrapper">
      <main id="main-content">
        @yield('content')
      </main>
      </div>
      @livewireScripts
  </body>
</html>
