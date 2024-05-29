

<header id="header-admin" class="fixed max-width-fixed top-0 left-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
  <div class="px-6 py-3">
    <div class="flex items-center justify-between">
      <div class="flex items-center justify-start rtl:justify-end">
        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg xl:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
               <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
            </svg>
        </button>
        <a href="https://flowbite.com" class="flex ms-2 xl:me-24">
          <img class="h-8 me-3 dark:hidden" src="{{ asset('images/logo-green.svg') }}" alt="" >
          <img class="h-8 me-3 hidden dark:block" src="{{ asset('images/logo-dashboard.svg') }}" alt="" >
          <span class="self-center text-xl font-semibold xl:text-2xl whitespace-nowrap dark:text-white">SRC Dashboard</span>
        </a>          
      </div>
      <div class="flex items-center">
        <div class="flex items-center gap-8">
          <div>
            <button onclick="toggleDarkMode()"
              class="h-5 w-5 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
              <svg class="fill-violet-700 block dark:hidden" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
              </svg>
              <svg class="fill-yellow-500 hidden dark:block" fill="currentColor" viewBox="0 0 20 20">
                  <path
                      d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                      fill-rule="evenodd" clip-rule="evenodd"></path>
              </svg>
            </button>
          </div>
          <div class="flex gap-3 items-center">
            <span class="hidden text-right lg:block">
              <span class="block text-sm font-medium text-black dark:text-white">{{ Auth::user()->first_name.' '. Auth::user()->last_name }}</span>
              <span class="block text-xs font-medium text-black dark:text-white">{{ Auth::user()->email }}</span>
            </span>
            <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
              <span class="sr-only">Open user menu</span>
              <img class="w-8 h-8 rounded-full" src="{{ asset('images/user.jpg') }}" alt="user photo">
            </button>
          </div>
          <div class="hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
            <div class="px-4 py-3 xl:hidden" role="none">
              <p class="text-sm text-gray-900 dark:text-white" role="none">
                {{ Auth::user()->first_name.' '. Auth::user()->last_name }}
              </p>
              <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                {{ Auth::user()->email }}
              </p>
            </div>
            <ul class="py-1" role="none">
              <li>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Dashboard</a>
              </li>
              <li>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Settings</a>
              </li>
              <li>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Earnings</a>
              </li>
              <li>
                <form method="POST" action="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">
                  @csrf
                  <x-responsive-nav-link :href="route('logout')"
                          onclick="event.preventDefault();
                                      this.closest('form').submit();">
                      {{ __('Log out') }}
                  </x-responsive-nav-link>
              </form>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
 
<aside id="logo-sidebar" class="fixed xl:relative top-0 left-0 z-40 w-64 h-screen pt-16 transition-transform -translate-x-full xl:translate-x-0 bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
   <div class="h-full px-6 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
      <ul class="space-y-2 font-medium">
         @foreach ($sideBar as $key => $item)
            @if (isset($item['has_sub']) && count($item['has_sub']) > 0)
               <li>
                  <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-{{ $key }}" data-collapse-toggle="dropdown-{{ $key }}">
                     {!! $item['icon'] !!}
                     <span class="flex-1 text-left rtl:text-right whitespace-nowrap mx-2">{{ $item['title'] }}</span>
                     <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                     </svg>
                  </button>
                  <ul id="dropdown-{{ $key }}" class="hidden py-2 space-y-2">
                     @foreach ($item['has_sub'] as $key => $subItem)
                     <li class="flex">
                        {{ $subItem['icon'] }}
                        <a href="{{ $subItem['url'] }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">{{ $subItem['title'] }}</a>
                     </li>
                     @endforeach
                  </ul>
               </li>
            @else
               <li>
                  <a href="{{ $item['url'] }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                     {!! $item['icon'] !!}
                     <span class="ml-2 whitespace-nowrap">{{ $item['title'] }}</span>
                  </a>
               </li>
            @endif
         @endforeach
      </ul>
   </div>
</aside>

