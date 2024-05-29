<header
    class="fixed z-9999 xl:duration-500 max-width transform-center w-full bg-black border-gray-20 py-2.5">
    <nav class="container">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
            <a href="{{ $header['linkPage'] }}" class="flex items-center">
                <img src="{{ $header['logoHeaderDark']['url'] }}" class="h-8 sm:h-12"
                    alt="{{ $header['logoHeaderDark']['alt'] }}" />
            </a>

            <div class="flex items-center order-1 xl:order-2">
                @if (Route::has('login'))
                    @auth
                        <div class="flex items-center">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center text-sm">
                                        <div class="relative me-1">
                                            <p
                                                class="menu-item text-white border-gray-100 xl:hover:text-primary-100 xl:p-0">
                                                Xin chào {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }} !</p>
                                        </div>
                                        <img src="{{ $header['logoHeaderDark']['url'] }}"
                                            alt="{{ $header['logoHeaderDark']['alt'] }}"
                                            class="w-8 h-8 rounded-full transition ease-in-out duration-150" width="24"
                                            height="24"></img>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Chỉnh sửa thông tin') }}
                                    </x-dropdown-link>

                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Quản lý bài viết') }}
                                    </x-dropdown-link>

                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Yêu cầu nhận nuôi') }}
                                    </x-dropdown-link>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                            {{ __('Đăng xuất') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-2 xl:px-5 py-2 xl:py-2.5 mr-2 focus:outline-none">Đăng
                            nhập</a>
                    @endauth
                @endif

                <button data-collapse-toggle="mobile-menu-2" type="button"
                    class="inline-flex items-center ml-2 text-sm text-gray-500 rounded-lg xl:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    aria-controls="mobile-menu-2" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

            @if (count($header['menu']) > 0)
                <div class="hidden justify-between items-center w-full inline-block order-2 xl:flex xl:w-auto xl:order-1"
                    id="mobile-menu-2">
                    <ul class="flex flex-col mt-4 font-medium xl:flex-row xl:space-x-8 xl:mt-0">
                        @foreach ($header['menu'] as $item)
                            @if (isset($item['submenu']) && count($item['submenu']) > 0)
                                <li>
                                    <button id="mega-menu-dropdown-button" data-dropdown-toggle="mega-menu-dropdown"
                                        class="relative menu-item flex items-center justify-between w-full py-2 pr-4 pl-3 text-white border-b border-gray-100 xl:border-0 xl:hover:text-primary-100 xl:p-0 {{ url()->current() == url($item['url']) ? 'active-menu' : '' }}">
                                        <span class="menu-item ">{{ $item['title'] }}</span> <svg
                                            class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 4 4 4-4" />
                                        </svg>
                                    </button>
                                    <div id="mega-menu-dropdown"
                                        class="absolute z-10 grid hidden w-auto text-sm bg-black border border-gray-100 rounded-lg shadow-md">
                                        <div class="p-4 pb-0 text-white md:pb-4">
                                            <ul class="space-y-4" aria-labelledby="mega-menu-dropdown-button">
                                                @foreach ($item['submenu'] as $submenuItem)
                                                    <li class="relative">
                                                        <a href="{{ $submenuItem['url'] }}"
                                                            class="menu-item  block w-full px-4 py-2 text-start text-sm leading-5 text-white border-b border-gray-100 hover:bg-gray-50 hover:bg-transparent border-0 hover:text-primary-100 sub-menu {{ url()->current() == url($item['url']) ? 'active-menu' : '' }}">
                                                            {{ $submenuItem['title'] }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            @else
                                <li class="relative">
                                    <a href="{{ $item['url'] }}"
                                        class="menu-item block py-2 pr-4 pl-3 text-white border-b border-gray-100 xl:border-0 xl:hover:text-primary-100 xl:p-0 {{ url()->current() == url($item['url']) ? 'active-menu' : '' }}">{{ $item['title'] }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </nav>
</header>
