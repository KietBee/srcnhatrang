@extends('layouts.app')

@section('content')
    <section>
        <x-admin.alerts :messages="session('error')" :error="true" />
        <x-admin.alerts :messages="session('success')" :error="false" />
        @livewire('pet-adoptions')
    </section>
@endsection
