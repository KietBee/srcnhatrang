<section class="mod-two-col animation">
    <div class="container">
        <div class="relative bg-white overflow-hidden ">
            <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 xl:max-w-2xl xl:w-full lg:pb-28 xl:pb-32">
                <svg class="hidden xl:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2"
                    fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                    <polygon points="50,0 100,0 50,100 0,100"></polygon>
                </svg>
        
                <div class="pt-1"></div>
        
                <div class="mt-10 xl:mx-0 mx-auto max-w-xl pr-4 sm:mt-12 sm:pr-6 md:mt-16 lg:mt-20 lg:pr-8 xl:mt-28">
                    <div class="sm:text-center xl:text-left anima-bottom">
                        {!! $content !!}
                    </div>
                </div>
            </div>
            <div class="xl:absolute xl:inset-y-0 xl:right-0 xl:w-1/2 delay-2 anima-right">
                <img class="mx-auto h-56 w-full object-cover object-top sm:h-72 md:h-full md:w-4/5 lg:w-1/2 xl:w-full" src="{{ $image['url'] }}" alt="{{ $image['alt'] }}">
            </div>
        </div>
    </div>
</section>