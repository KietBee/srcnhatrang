<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('components.admin.head')
    <body class="bg-gray-50 dark:bg-gray-900 max-width">
    <!-- ===== Preloader Start ===== -->
    <!-- ===== Preloader End ===== -->
    <!-- ===== Page Wrapper Start ===== -->
    <div class="w-full bg-gray-50 dark:bg-gray-900 flex h-screen overflow-hidden">
      <!-- ===== Sidebar Start ===== -->
      @include('components.admin.sidebar')
      <!-- ===== Sidebar End ===== -->
      <!-- ===== Main Content Start ===== -->
      <main id="main-content" class="pt-20 mx-5 w-full relative overflow-hidden overflow-y-auto">
        @yield('content')
      </main>
      <!-- ===== Main Content End ===== -->
    </div>
    <!-- ===== Page Wrapper End ===== -->
    @livewireScripts
  </body>
</html>