@extends('layouts.admin')
@section('content')
<section id="admin-specie" class="bg-gray-50 dark:bg-gray-900 py-3 sm:py-5">
    <x-admin.alerts :messages="session('error')" :error="true" />
    <x-admin.alerts :messages="session('success')" :error="false" />
    <div class="mx-auto">
        <x-admin.form-update buttonName="Cập nhật loại thú cưng" goBack="{{ route('admin.species')}}" route="{{ route('admin.species.update', ['id' => $specie->specie_id]) }}">
            @method('PATCH')
            <div class="col-span-2">
                <label for="specie_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Loại thú cưng</label>
                <input type="text" name="specie_name" id="specie_name" value="{{ $specie->specie_name!=''? $specie->specie_name : old('specie_name') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 respecie-none dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Nhập loại thú cưng" required></input>
            </div>
        </x-admin.form-update>
    </div>
</section>
@endsection
