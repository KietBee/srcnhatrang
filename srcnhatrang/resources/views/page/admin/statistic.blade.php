@extends('layouts.admin')

@section('content')

<section id="admin-statistic" class="bg-gray-50 dark:bg-gray-900 py-3 sm:py-5">
  @livewire('statistic-table')
</section>
@endsection
