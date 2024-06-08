@extends('layouts.admin')
@section('content')
<section id="admin-breed" class="bg-gray-50 dark:bg-gray-900 py-3 sm:py-5">
    <x-admin.alerts :messages="session('error')" :error="true" />
    <x-admin.alerts :messages="session('success')" :error="false" />

    <div class="mx-auto">
        <div class="w-full py-4 flex flex-shrink-0">
            <x-admin.modal-create buttonName="Thêm loại thú cưng" route="{{ route('admin.breed.create') }}">
                <div class="col-span-2 sm:col-span-1">
                    <label for="specie_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Loại tài khoản</label>
                    <select id="specie_id" name="specie_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                      @foreach($listSpecies as $key => $type)
                        <option value="{{ $type->specie_id }}" {{ old('specie_id') == $type->specie_id ? 'selected' : '' }}>{{ $type->specie_name }}</option>
                      @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('specie_id')" class="mt-2" />
                </div>
                <div class="col-span-2">
                    <label for="breed_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Giống thú cưng</label>
                    <input type="text" name="breed_name" id="breed_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 rebreed-none dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Nhập giống thú cưng" required value="{{ old('breed_name') }}"></input>
                    <x-input-error :messages="$errors->get('breed_name')" class="mt-2" />
                </div>
            </x-admin.modal-create>
        </div>
    </div>

    <livewire:breed-table/>
</section>
@endsection
