@extends('layouts.admin')
@section('content')
<section id="admin-user-type" class="bg-gray-50 dark:bg-gray-900 py-3 sm:py-5">
    <x-admin.alerts :messages="session('error')" :error="true" />
    <x-admin.alerts :messages="session('success')" :error="false" />

    <div class="mx-auto">
        <div class="w-full py-4 flex flex-shrink-0">
            <x-admin.modal-create buttonName="Thêm loại người dùng" route="{{ route('admin.user-type.create') }}">
                <div class="col-span-2">
                    <label for="user_type_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Loại người dùng</label>
                    <input type="text" name="user_type_name" id="user_type_name" rows="5" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 resize-none dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Nhập loại người dùng" required value="{{ old('user_type_name') }}"></input>
                    <x-input-error :messages="$errors->get('user_type_name')" class="mt-2" />
                </div>
            </x-admin.modal-create>
        </div>
    </div>

    <livewire:user-type-table/>
</section>
@endsection
