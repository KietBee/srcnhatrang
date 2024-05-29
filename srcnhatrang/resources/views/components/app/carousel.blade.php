@props(['slider'])

@if ($slider && count($slider) > 0)
    <section id="default-carousel" class="relative w-full" data-carousel="slide">
        <!-- Carousel wrapper -->
        <div class="relative h-56 overflow-hidden md:h-screen">
            <div class="container">
                @foreach ($slider as $item)
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <div class="absolute block z-50 sm:text-center xl:text-left delay-5 anima-bottom bg-transparent text-black">
                            {!! $item['content'] !!}
                        </div>
                        <img src="{{ $item['url'] }}"
                            class="absolute block w-full h-full object-cover object-top"
                            alt="{{ $item['alt'] }}">
                    </div>
                
            @endforeach
            </div>
        </div>
        <!-- Slider indicators -->
        <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
            @foreach ($slider as $index => $item)
                @if ($index == 0)
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="true"
                        aria-label="Slide {{ $index + 1 }}" data-carousel-slide-to="{{ $index }}"></button>
                @else
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="false"
                        aria-label="Slide {{ $index + 1 }}" data-carousel-slide-to="{{ $index }}"></button>
                @endif
            @endforeach
        </div>
        <!-- Slider controls -->
        <button type="button"
            class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            data-carousel-prev>
            <span
                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
                <span class="icomoon icon-foot text-white -rotate-90" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button"
            class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            data-carousel-next>
            <span
                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
                <span class="icomoon icon-foot text-white rotate-90" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </section>
@endif
