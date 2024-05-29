@props(['homeBanner'])
<section class="mod-banner relative">
    <div class="inset-0 absolute z-0">
        <div class="absolute inset-0">
            <img src="{{ $homeBanner['background'] }}"
                class="object-cover w-full h-full" width="450" height="450" alt=" ">
        </div>
    </div>
    <div class="container relative flex text-white min-h-[618px] md:min-h-[749px]">
        <div class="flex items-center -mt-11 2xl:items-end 2xl:-mb-7 2xl:p-20">
            <div class="w-full banner-title 2xl:w-5/12">
                {{ $homeBanner['content'] }}
            </div>
        </div>
    </div>
</section>