@extends('layouts.app')

@section('content')

<section id="admin-user" class="bg-gray-50 dark:bg-gray-900 bg-opacity-70">
    <div class="container">
        @include('components.app.carousel', ['slider' => $bannerSlide])
        @include('components.app.card-full-width-tab')
        @include('components.app.card-single')
    </div>
    @include('modules.list-post-card')
</section>
@endsection
