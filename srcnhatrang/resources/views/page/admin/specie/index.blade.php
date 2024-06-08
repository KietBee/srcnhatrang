@extends('layouts.admin')
@section('content')
<section id="admin-specie" class="bg-gray-50 dark:bg-gray-900 py-3 sm:py-5">
    <x-admin.alerts :messages="session('error')" :error="true" />
    <x-admin.alerts :messages="session('success')" :error="false" />

    <div class="mx-auto">
        <div class="w-full py-4 flex flex-shrink-0">
            <x-admin.modal-create buttonName="Thêm loại thú cưng" route="{{ route('admin.species.create') }}">
                <div class="col-span-2">
                    <label for="specie_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kích thước thú cưng</label>
                    <input type="text" name="specie_name" id="specie_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 respecie-none dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Nhập loại thú cưng" required value="{{ old('specie_name') }}"></input>
                    <x-input-error :messages="$errors->get('specie_name')" class="mt-2" />
                </div>
            </x-admin.modal-create>
        </div>
    </div>

    <livewire:specie-table/>
</section>
@endsection
