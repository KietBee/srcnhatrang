@extends('layouts.app')

@section('content')
    <section class="mb-10 mt-[-68px]">
        @include('components.app.carousel', ['slider' => $bannerSlide])
        {{-- @include('modules.home-banner', ['homeBanner' => $homeBanner]) --}}
        <div class="h-10"></div>
        @include('modules.mod-two-col', ['content' => $aboutUs['content'], 'image' => ['url' => $aboutUs['image']['url'], 'alt' => $aboutUs['image']['alt']]])
        <div class="h-10"></div>
        @include('components.app.card-full-width-tab')
        <div class="h-10"></div>
        @include('components.app.post-single', ['content' => $postPetAdoption])
        <div class="h-10"></div>
        @include('modules.list-post-card', ['content' => $listStories])
    </section>
@endsection
