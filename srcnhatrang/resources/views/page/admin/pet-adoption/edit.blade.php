@extends('layouts.admin')
@section('content')
<section id="admin-pet-adoption" class="bg-gray-50 dark:bg-gray-900 py-3 sm:py-5">
    <x-admin.alerts :messages="session('error')" :error="true" />
    <x-admin.alerts :messages="session('success')" :error="false" />
    
    <?php var_dump($petAdoption); ?>
</section>
@endsection