

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
        <a href="{{ route('home') }}" class="flex ms-2 xl:me-24">
          <img class="h-8 me-3 dark:hidden" src="{{ asset('images/logo-green.svg') }}" alt="" >
          <img class="h-8 me-3 hidden dark:block" src="{{ asset('images/logo-dashboard.svg') }}" alt="" >
          <span class="self-center text-xl font-semibold xl:text-2xl whitespace-nowrap dark:text-white">SRC Nha Trang</span>
        </a>          
      </div>
      <div class="flex items-center">
        <div class="flex items-center gap-8">
          <div class="flex gap-3 items-center">
            <span class="hidden text-right lg:block">
              <span class="block text-sm font-medium text-black dark:text-white">{{ Auth::user()->first_name.' '. Auth::user()->last_name }}</span>
              <span class="block text-xs font-medium text-black dark:text-white">{{ Auth::user()->email }}</span>
            </span>
            <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
              <span class="sr-only">Open user menu</span>
              <img class="w-8 h-8 rounded-full" src="{{ asset('storage/images/user.jpg') }}" alt="user photo">
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
                <form method="POST" action="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">
                  @csrf
                  <x-responsive-nav-link :href="route('logout')"
                          onclick="event.preventDefault();
                                      this.closest('form').submit();">
                      {{ __('Đăng xuất') }}
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
   <div id="sidebar" class="h-full px-6 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
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
                  <ul id="dropdown-{{ $key }}" class="hidden pl-3 py-2 space-y-2">
                     @foreach ($item['has_sub'] as $key => $subItem)
                     <li class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        {!! $subItem['icon'] !!}
                        <a href="{{ $subItem['url'] }}" class="flex ml-2 items-center w-full text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">{{ $subItem['title'] }}</a>
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

