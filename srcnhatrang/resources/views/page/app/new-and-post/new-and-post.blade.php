@extends('layouts.app')

@section('content')
    <section>
        <x-admin.alerts :messages="session('error')" :error="true" />
        <x-admin.alerts :messages="session('success')" :error="false" />
        @livewire('list-new-and-post')
        @include('components.app.speed-dial')
    </section>
@endsection
