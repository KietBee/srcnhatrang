<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  @include('components.app.head')
  <body class="bg-white has-animation">
  @include('components.loading')
  <div id="wrapper" class="wrapper has-animation">
    @include('components.app.header')
    {{-- @include('layouts.navigation') --}}
    <main id="main-content">
      <div class="h-[68px]"></div>
      @yield('content')
    </main>
    {{-- <x-responsive-nav-link :href="route('profile.edit')">
      {{ __('Profile') }}
    </x-responsive-nav-link> --}}
    @include('components.app.footer', ['footer' => $footer])
    </div>
    @livewireScripts
  </body>
</html>
