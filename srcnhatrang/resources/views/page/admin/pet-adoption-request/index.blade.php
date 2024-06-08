@extends('layouts.admin')
@section('content')
<section id="admin-pet-adoption-request" class="bg-gray-50 dark:bg-gray-900 py-3 sm:py-5">
    <x-admin.alerts :messages="session('error')" :error="true" />
    <x-admin.alerts :messages="session('success')" :error="false" />
    <livewire:pet-adoption-request-table/>
</section>
@endsection
