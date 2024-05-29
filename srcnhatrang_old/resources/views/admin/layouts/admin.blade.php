{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  @include('components.head')
  <body>
  @include('components.loading')
  <div id="wrapper" class="wrapper has-animation">
    @include('components.admin.header')
    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <x-responsive-nav-link :href="route('logout')"
                onclick="event.preventDefault();
                            this.closest('form').submit();">
            {{ __('Log Out') }}
        </x-responsive-nav-link>
    </form>
    <main id="main-content">
      @yield('content')
    </main>
    @include('components.footer')
    
    </div>
  </body>
</html> --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('admin.components.head')
    <body class="bg-gray-50 dark:bg-gray-900 max-width">
    <!-- ===== Preloader Start ===== -->
    @include('admin.components.preloader')
    <!-- ===== Preloader End ===== -->
    <!-- ===== Page Wrapper Start ===== -->
    <div class="w-full bg-gray-50 dark:bg-gray-900 flex h-screen overflow-hidden">
      <!-- ===== Sidebar Start ===== -->
      @include('admin.components.sidebar')
      <!-- ===== Sidebar End ===== -->
      <!-- ===== Main Content Start ===== -->
      <main id="main-content" class="pt-20 mx-5 w-full relative overflow-x-hidden overflow-y-scroll">
        @yield('content')
      </main>
      <!-- ===== Main Content End ===== -->
    </div>
    <!-- ===== Page Wrapper End ===== -->
  </body>
</html>