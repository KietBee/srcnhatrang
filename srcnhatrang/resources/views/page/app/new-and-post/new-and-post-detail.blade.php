@extends('layouts.app')

@section('content')
    <section class="container animation">
        <x-admin.alerts :messages="session('error')" :error="true" />
        <x-admin.alerts :messages="session('success')" :error="false" />
        <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900 antialiased">
            <div class="flex justify-between px-4 mx-auto max-w-screen-xl ">
                <article
                    class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
                    <header class="mb-4 lg:mb-6 not-format anima-bottom">
                        <address class="flex items-center mb-6 not-italic">
                            <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                                <img class="mr-4 w-16 h-16 rounded-full" src="{{ $story->author->avatar }}"
                                    alt="{{ $story->author->first_name . ' ' . $story->author->last_name }}">
                                <div>
                                    <a href="#" rel="author"
                                        class="text-xl font-bold text-gray-900 dark:text-white">{{ $story->author->first_name . ' ' . $story->author->last_name }}</a>
                                    <p class="text-base text-gray-500 dark:text-gray-400">
                                        {{ implode(', ', array_map(fn($category) => "#$category", $listCategories)) }}</p>
                                    <p class="text-base text-gray-500 dark:text-gray-400"><time pubdate
                                            datetime="{{ $story->approved_at }}"
                                            title="{{ $story->approved_at }}">{{ $story->approved_at }}</time></p>
                                </div>
                            </div>
                        </address>
                        <h1
                            class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">
                            {{ $story->title }}</h1>
                    </header>
                    <figure class="anima-bottom delay-2 my-6"><img src="{{ $story->feature_image_url }}"
                            alt="{{ $story->title }}">
                        <figcaption>{{ $story->title }}</figcaption>
                    </figure>
                    <div class="anima-bottom delay-5">
                        {{ $story->content }}
                    </div>
                </article>
            </div>
        </main>
            @if(count($relatedStories) > 0)
            <aside aria-label="Related articles" class="py-8 lg:py-24 bg-gray-50 dark:bg-gray-800">
                <div class="px-4 mx-auto max-w-screen-xl">
                    <h2 class="mb-8 text-2xl font-bold text-gray-900 dark:text-white">Bài viết liên quan</h2>
                    <div class="grid gap-12 sm:grid-cols-2 lg:grid-cols-4">
                        @forelse($relatedStories as $index => $item)
                        <article class="max-w-xs anima-bottom delay-{{ $index * 2 }}">
                            <a href="{{ route('new-and-post.details', ['id' => $item->story_id]) }}">
                                <img src="{{ $item->feature_image_url }}" class="mb-5 rounded-lg" alt="Image 1">
                            </a>
                            <h2 class="mb-2 text-xl font-bold leading-tight text-gray-900 dark:text-white max-content-3">
                                {{ $item->title }}
                            </h2>
                            <p class="mb-4 text-gray-500 dark:text-gray-400 max-content-3">{{ $item->content }}</p>
                            <a href="#"
                                class="inline-flex items-center font-medium underline underline-offset-4 text-primary-600 dark:text-primary-500 hover:no-underline">
                                {{ $item->approved_at }}
                            </a>
                        </article>
                        @empty
                        @endforelse
                    </div>
                </div>
            </aside>
            @endif
        <div data-dial-init class="fixed flex end-6 bottom-6 group">
            <div id="speed-dial-menu-horizontal" class="flex items-center hidden me-4 space-x-2 rtl:space-x-reverse">
                <a href="https://pinterest.com/pin/create/button/?url={{ urlencode(Request::url()) }}&description={{ urlencode($story->title) }}" target="_blank" data-tooltip-target="tooltip-pinterest" data-tooltip-placement="top" class="flex justify-center items-center w-[52px] h-[52px] text-gray-500 hover:tex-white hover:bg-primary-100 bg-white rounded-full border border-gray-200 dark:border-gray-600 shadow-sm dark:hover:text-white dark:text-gray-400 dark:bg-gray-700 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M204 6.5C101.4 6.5 0 74.9 0 185.6 0 256 39.6 296 63.6 296c9.9 0 15.6-27.6 15.6-35.4 0-9.3-23.7-29.1-23.7-67.8 0-80.4 61.2-137.4 140.4-137.4 68.1 0 118.5 38.7 118.5 109.8 0 53.1-21.3 152.7-90.3 152.7-24.9 0-46.2-18-46.2-43.8 0-37.8 26.4-74.4 26.4-113.4 0-66.2-93.9-54.2-93.9 25.8 0 16.8 2.1 35.4 9.6 50.7-13.8 59.4-42 147.9-42 209.1 0 18.9 2.7 37.5 4.5 56.4 3.4 3.8 1.7 3.4 6.9 1.5 50.4-69 48.6-82.5 71.4-172.8 12.3 23.4 44.1 36 69.3 36 106.2 0 153.9-103.5 153.9-196.8C384 71.3 298.2 6.5 204 6.5z"/></svg>
                    <span class="sr-only">pinterest</span>
                </a>
                <div id="tooltip-pinterest" role="tooltip" class="absolute z-10 invisible inline-block w-auto px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    Pinterest
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(Request::url()) }}" target="_blank" data-tooltip-target="tooltip-linkedin" data-tooltip-placement="top" class="flex justify-center items-center w-[52px] h-[52px] text-gray-500 hover:tex-white hover:bg-primary-100 bg-white rounded-full border border-gray-200 dark:border-gray-600 shadow-sm dark:hover:text-white dark:text-gray-400 dark:bg-gray-700 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M12.51 8.796v1.697a3.738 3.738 0 0 1 3.288-1.684c3.455 0 4.202 2.16 4.202 4.97V19.5h-3.2v-5.072c0-1.21-.244-2.766-2.128-2.766-1.827 0-2.139 1.317-2.139 2.676V19.5h-3.19V8.796h3.168ZM7.2 6.106a1.61 1.61 0 0 1-.988 1.483 1.595 1.595 0 0 1-1.743-.348A1.607 1.607 0 0 1 5.6 4.5a1.601 1.601 0 0 1 1.6 1.606Z" clip-rule="evenodd"/>
                        <path d="M7.2 8.809H4V19.5h3.2V8.809Z"/>
                      </svg>
                      
                    <span class="sr-only">linkedin</span>
                </a>
                <div id="tooltip-linkedin" role="tooltip" class="absolute z-10 invisible inline-block w-auto px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    Linkedin
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(Request::url()) }}&text={{ urlencode($story->title) }}" target="_blank" data-tooltip-target="tooltip-twitter" data-tooltip-placement="top" class="flex justify-center items-center w-[52px] h-[52px] text-gray-500 hover:tex-white hover:bg-primary-100 bg-white rounded-full border border-gray-200 dark:border-gray-600 shadow-sm dark:hover:text-white dark:text-gray-400 dark:bg-gray-700 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path fill="currentColor" d="M12.186 8.672 18.743.947h-2.927l-5.005 5.9-4.44-5.9H0l7.434 9.876-6.986 8.23h2.927l5.434-6.4 4.82 6.4H20L12.186 8.672Zm-2.267 2.671L8.544 9.515 3.2 2.42h2.2l4.312 5.719 1.375 1.828 5.731 7.613h-2.2l-4.699-6.237Z"/>
                    </svg>
                      
                    <span class="sr-only">twitter</span>
                </a>
                <div id="tooltip-twitter" role="tooltip" class="absolute z-10 invisible inline-block w-auto px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    Twitter
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::url()) }}" target="_blank" data-tooltip-target="tooltip-facebook" data-tooltip-placement="top" class="flex justify-center items-center w-[52px] h-[52px] text-gray-500 hover:text-white bg-white hover:bg-primary-100 rounded-full border border-gray-200 dark:border-gray-600 dark:hover:text-white shadow-sm dark:text-gray-400 dark:bg-gray-700 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M13.135 6H15V3h-1.865a4.147 4.147 0 0 0-4.142 4.142V9H7v3h2v9.938h3V12h2.021l.592-3H12V6.591A.6.6 0 0 1 12.592 6h.543Z" clip-rule="evenodd"/>
                      </svg>                      
                    <span class="sr-only">facebook</span>
                </a>
                <div id="tooltip-facebook" role="tooltip" class="absolute z-10 invisible inline-block w-auto px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    facebook
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </div>
            <button type="button" data-dial-toggle="speed-dial-menu-horizontal" aria-controls="speed-dial-menu-horizontal" aria-expanded="false" class="flex items-center justify-center text-white bg-primary-900 rounded-full w-14 h-14 hover:bg-primary-100 focus:ring-4 focus:ring-blue-300 focus:outline-none">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                    <path d="M14.419 10.581a3.564 3.564 0 0 0-2.574 1.1l-4.756-2.49a3.54 3.54 0 0 0 .072-.71 3.55 3.55 0 0 0-.043-.428L11.67 6.1a3.56 3.56 0 1 0-.831-2.265c.006.143.02.286.043.428L6.33 6.218a3.573 3.573 0 1 0-.175 4.743l4.756 2.491a3.58 3.58 0 1 0 3.508-2.871Z"/>
                </svg>
                <span class="sr-only">Open actions menu</span>
            </button>
        </div>
    </section>
@endsection
