@extends('layouts.app')

@section('content')
    <section class="container animation">
        <x-admin.alerts :messages="session('error')" :error="true" />
        <x-admin.alerts :messages="session('success')" :error="false" />
        <div class="py-10 grid xl:grid-cols-2">
            <div class="grid gap-4">
                <div>
                    @if (file_exists(public_path('storage/images/app/upload' . $petAdoption->image_feature)))
                        <img class="h-auto max-w-full rounded-lg anima-bottom"
                            src="{{ asset('storage/images/' . $petAdoption->image_feature) }}"
                            alt="{{ $petAdoption->title }}" />
                    @else
                        <img class="h-auto max-w-full rounded-lg anima-bottom" src="{{ asset('storage/images/default.jpg') }}"
                            alt="Default Image" />
                    @endif
                </div>
                <div class="grid grid-cols-5 gap-4">
                    @if ($listImage->isNotEmpty())
                        @foreach ($listImage as $index => $image)
                            <div>
                                <img class="h-auto max-w-full rounded-lg anima-bottom delay-{{ $index + 2 }}"
                                    src="{{ $image->pet_image }}" alt="{{ $image->title }}">
                            </div>
                        @endforeach
                    @else
                        <div>
                            <img class="h-auto max-w-full rounded-lg anima-bottom"
                                src="{{ asset('storage/images/default.jpg') }}" alt="Default Image" />
                        </div>
                    @endif
                </div>
            </div>
            <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900 antialiased">
                <div class="flex justify-between px-4 mx-auto max-w-screen-xl ">
                    <article
                        class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
                        <h1
                            class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">
                            {{ $petAdoption->title }}</h1>
                        <div class="anima-bottom delay-5">
                            {{ $petAdoption->description }}
                        </div>
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ route('pet-adoptions-requests.requests', ['id' => $petAdoption->pet_adoption_id]) }}"
                                    class="anima-bottom delay-7 bg-gradient-to-r inline-block mt-6 from-black to-primary-300 text-white px-4 py-2 text-xl rounded-3xl font-medium focus:ring ring-black ring-opacity-10 gradient element-to-rotate">Gửi
                                    yêu cầu nhận nuôi</a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="bg-gradient-to-r inline-block mt-6 from-black to-primary-300 anima-bottom delay-7 text-white px-4 py-2 text-xl rounded-3xl font-medium focus:ring ring-black ring-opacity-10 gradient element-to-rotate">Bạn
                                    phải đăng nhập để gửi yêu cầu nhận nuôi</a>
                            @endauth
                        @endif

                    </article>
                </div>
            </main>
        </div>
        @if (count($relatedPetAdoptions) > 0)
            <aside aria-label="Related articles" class="py-8 lg:py-24 bg-gray-50 dark:bg-gray-800">
                <div class="px-4 mx-auto max-w-screen-xl">
                    <div class="flex justify-between mb-10">
                        <h2 class="text-2xl font-bold tracking-tight anima-left">Các thú cưng khác</h2>
                        <a href="{{ route('pet-adoptions') }}"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 anima-right">
                            Xem tất cả
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </a>
                    </div>
                    <div class="grid gap-12 sm:grid-cols-2 lg:grid-cols-4">
                        @forelse($relatedPetAdoptions as $index => $item)
                            <article class="max-w-xs anima-bottom delay-{{ $index * 2 }}">
                                <a href="{{ route('pet-adoptions.details', ['id' => $item->pet_adoption_id]) }}">
                                    @if (file_exists(public_path('storage/images/app/upload' . $item->image_feature)))
                                        <img class="mb-5 rounded-lg"
                                            src="{{ asset('storage/images/' . $item->image_feature) }}"
                                            alt="{{ $item->title }}" />
                                    @else
                                        <img class="mb-5 rounded-lg" src="{{ asset('storage/images/default.jpg') }}"
                                            alt="Default Image" />
                                    @endif
                                </a>
                                <h2
                                    class="mb-2 text-xl font-bold leading-tight text-gray-900 dark:text-white max-content-3">
                                    {{ $item->title }}
                                </h2>
                                <p class="mb-4 text-gray-500 dark:text-gray-400 max-content-3">{{ $item->description }}</p>
                                <a href="#"
                                    class="inline-flex items-center font-medium underline underline-offset-4 text-primary-600 dark:text-primary-500 hover:no-underline">
                                    {{ $item->created_at }}
                                </a>
                            </article>
                        @empty
                        @endforelse
                    </div>
                </div>
            </aside>
        @endif
    </section>
@endsection
