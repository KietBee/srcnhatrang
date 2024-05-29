<header id="header" class="module header w-full top-0 left-0 fixed z-200 down_lg:overflow-hidden bg-[#202C40] h-[111px] xl:mr-[252px] lg:pt-14 down_md:pt-17 bg-blue-#1F2C40 down_xl:pt-13.5">
    <div class="container">
        <nav class="row navbar items-center pl-48.5 pr-48.5 down_1920:pl-55 down_1920:pr-47.5 down_xl:pl-40.5 down_xl:pr-16 down_lg:pr-19 down_lg:pl-25">
            <div class="col w-full down_lg:flex down_lg:flex-wrap lg:w-30% header-mobile relative justify-between items-center">
                <div class="lg:w-full relative">
                    <a id="header-logo" class="navbar-brand header-logo py-5 inline-block align-middle"
                        href="{!! App::getLogo()['href'] !!}">
                        <img src="{!! App::getLogo()['url'] !!}" alt="{!! App::getLogo()['alt'] !!}" class="w-full screen">
                        <img src="@asset('images/print_logo.png')" alt="Logo Encompass" class="w-full hidden print">
                    </a>
                </div>
                <div class="block lg:hidden">
                    <button class="navbar-toggler hamburger-menu p-5.5 mt-3 cursor-pointer" type="button"
                        data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="icon-bar block bg-white relative ml-auto w-14 h-0.125"></span>
                        <span class="icon-bar block bg-white relative ml-auto w-14 h-1.125 mt-4.5 mb-4.5"></span>
                        <span class="icon-bar block bg-white relative ml-auto w-14 h-0.125"></span>
                        <span class="sr-only">Open Menu</span>
                    </button>
                </div>
            </div>

            <div class="col w-full lg:w-70% navbar-collapse main-menu flex flex-col justify-between down_1920:-mt-1 down_xl:p-0 down_xl:-ml-6.2vw down_lg:-ml-2.7vw" id="main-menu" data-module="menu">
                {!! App::getMainNav() !!}
            </div>
        </nav>
    </div>
</header