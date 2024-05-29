@extends('layouts.app')

@section('content')
    <section>
        @include('modules.mod-two-col', ['content' => $aboutUs['content'], 'image' => ['url' => $aboutUs['image']['url'], 'alt' => $aboutUs['image']['alt']]])
    </section>
@endsection
