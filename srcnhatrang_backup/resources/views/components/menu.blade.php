<nav class="navbar-collapse main-menu 2xl:pt-1 down_lg:text-xl font-medium down_lg:text-white px-12 relative z-0 down_lg:h-[100vh]" id="main-menu" data-module="menu">
  <ul class="main-menu-ul navbar-nav ml-auto gap-16 md:gap-[33px] lg:gap-5 flex flex-col lg:flex-row list-none pl-0 mb-0 pt-49 lg:pt-0">
    @foreach ($header['menu'] as $item)
      {{-- {% if item.sub_menu is defined and item.sub_menu %}
      <li class="menu-item active has-sub lg:static mega-dropdown mb-7 xl:px-10 lg:my-15">
        <a href="{{ item.url }}" class="main-link">{{ item.title }}</a>
        <button type="button" aria-label="open dropdown menu {{ item.title }}" aria-expanded="false" aria-controls="dropdown-menu-{{ loop.index }}">
          <span class="icon-arrow-menu inline-block text-white p-3p5 lg:px-2 lg:py-0">
            <span class="icomoon icon-chevron-down block"></span>
          </span>
        </button>
        <div id="dropdown-menu-{{ loop.index }}"
          class="dropdown-menu main-menu-dropdown rounded-0 border-0 lg:absolute top-full lg:bg-white lg:opacity-0 lg:w-[248px] lg:-ml-11 lg:mt-5 down_lg:hidden">
          <ul class="list-inline list-none m-0 pl-0 text-primary-400">
            {% for subMenu in item.sub_menu %}
              <li class="m-0 inline-block w-full lg:border-b-1 lg:border-gray-300">
                <a href="{{ subMenu.url }}" class="block lg:px-11 lg:pt-5 lg:pb-[11px]">{{ subMenu.title }}</a>
              </li>
            {%endfor%}
          </ul>
        </div>
      </li>
      {%else%} --}}
      <li class="menu-item xl:px-10 mb-7 lg:my-15">
        <a href="{{ $item['url'] }}" class="main-link">{{ $item['title'] }}</a>
      </li>
      {{-- {%endif%} --}}
    @endforeach
  </ul>
  {{-- <div class="lg:hidden md:mt-[438px] mt-87 ml-1p5">
    {% include "components/social.html" %}
  </div>
  <div class="lg:hidden bg-menu absolute top-0 right-0 -z-1 md:right-10">
    <picture>
      <source media="(min-width:768px)" srcset="assets/images/Home/header/image_menu_tablet.svg">
      <img src="assets/images/Home/header/image_menu_mobile.svg" class="w-full" width="450" height="1000" alt="{{banner.background_image.image_mobile.alt}}">
    </picture>
  </div> --}}
</nav>