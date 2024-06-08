@extends('layouts.admin')
@section('content')
<section id="admin-pet-image" class="bg-gray-50 dark:bg-gray-900 py-3 sm:py-5">
    <x-admin.alerts :messages="session('error')" :error="true" />
    <x-admin.alerts :messages="session('success')" :error="false" />

    <div class="mx-auto">
        <div class="w-full py-4 flex flex-shrink-0">
            <x-admin.modal-create buttonName="Thêm ảnh thú cưng" route="{{ route('admin.pet-image.create') }}">
                <div class="col-span-2 sm:col-span-1">
                    <label for="pet_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tên thú cưng</label>
                    <select id="pet_id" name="pet_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                      @foreach($listPets as $key => $type)
                        <option value="{{ $type->pet_id }}" {{ old('pet_id') == $type->pet_id ? 'selected' : '' }}>{{ $type->pet_name }}</option>
                      @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('pet_id')" class="mt-2" />
                </div>
                <div class="mb-6 col-span-2">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Tải hình
                        ảnh</label>
                    <input
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        aria-describedby="file_input_help" id="file_input" type="file" name="pet_image" required>
                    <p class="mt-1 mb-6 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or GIF
                        (Kích thước tối đa.
                        800x400px).</p>
                </div>
            </x-admin.modal-create>
        </div>
    </div>

    <livewire:pet-image-table/>
</section>
@endsection
