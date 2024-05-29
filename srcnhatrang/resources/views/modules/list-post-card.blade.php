@props(['content'])
@if (isset($content))
    <section class="list-post-card animation">
        <div class="container">
            <div class="flex justify-between mb-10">
                <h2 class="text-2xl font-bold tracking-tight anima-left">{{ $content['headline'] }}</h2>
                <a href="{{ $content['linkAll']['url'] }}"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 anima-right">
                    {{ $content['linkAll']['title'] }}
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
            </div>
            <div class="grid gap-6 grid-cols-1 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($content['postStories'] as $index => $item)
                    <div class="anima-bottom delay-{{ $index * 2 + 4 }} h-full">
                        @include('components.app.card-single', ['content' => $item])
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
