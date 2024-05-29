<header id="header" class="module header text-white lg:duration-500 max-width fixed transform-center z-50 w-full bg-transparent py-8" data-module="header">
  <div class="container navbar navbar-expand-lg lg:flex items-center justify-between">
    <div class="header-mobile row items-center justify-between flex-wrap animation">
      <div class="col logo-header">
        <a id="header-logo" class="navbar-brand max-w-75 md:max-w-[280px] w-full inline-block align-middle lg:px-21 p-0" href="/">
          <img src="{{ $header['logoHeader']['url'] }}" alt="{{ $header['logoHeader']['alt'] }}" width="100" height="100" />
        </a>
        {{-- <a id="pin-logo" class="navbar-brand max-w-75 md:max-w-[280px] w-full align-middle lg:px-21 p-0 hidden" href="/">
          <img src="{{header.logo_pin_image.url}}" class="w-full" alt="{{header.logo_pin_image.alt}}" width="181" height="74" />
        </a> --}}
      </div>
      <div class="px-12 pt-4 text-center relative lg:hidden">
        <button class="border-0 hamburger-menu" type="button" data-toggle="collapse" data-target="#main-menu"
          aria-controls="main-menu" aria-expanded="false">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icomoon icon-close hidden absolute -top-7 right-2 text-[56px] z-1 md:right-15"></span>
          <span class="sr-only">Open Menu</span>
        </button>
      </div>
    </div>
    <div class="flex items-center">
      @include('components.menu')
      <a class="py-3 px-4 text-sm font-semibold rounded text-white bg-red-600 hover:bg-gray-800 focus:outline-none items-center border border-transparent tracking-widest focus:bg-gray-700 active:bg-gray-900 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
        <span class="icomoon icon-icon-search"></span> Quyên góp
      </a>
      <span class="icomoon icon-icon-search"></span>
      <div class="hidden sm:flex sm:items-center sm:ms-6">
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                    <div class="ms-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('login')">
                    {{ __('Login') }}
                </x-dropdown-link>
                <x-dropdown-link :href="route('register')">
                  {{ __('Register') }}
                </x-dropdown-link>
            </x-slot>
        </x-dropdown>
      </div>
    </div>
  </div>
</header>