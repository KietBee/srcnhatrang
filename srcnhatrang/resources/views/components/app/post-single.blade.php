@props(['content'])
@if (isset($content))
    <section class="post-single animation">
        <div class="container">
            <div class="bg-white border border-gray-200 rounded-lg shadow xl:flex">
                <div class="w-full xl:w-2/5">
                    <img class="down_xl:rounded-t-lg xl:rounded-l-lg w-full delay-2 anima-left" src="{{ $content['image']['url'] }}"
                        alt="{{ $content['image']['alt'] }}" />
                </div>
                <div class="w-full xl:w-3/5 p-5">
                    <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 delay-4 anima-right">{{ $content['title'] }}</h2>
                    <p class="mb-3 font-normal text-gray-700 delay-6 anima-right">{{ $content['description'] }}</p>
                    <a href="{{ $content['link']['url'] }}"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 delay-8 anima-right">
                        {{ $content['link']['title'] }}
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                    @if (isset($content['linkAll']) && $content['linkAll'])
                        <a href="{{ $content['linkAll']['url'] }}"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 delay-10 anima-right">
                            {{ $content['linkAll']['title'] }}
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endif
