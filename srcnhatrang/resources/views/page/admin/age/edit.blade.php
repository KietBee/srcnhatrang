@extends('layouts.admin')
@section('content')
<section id="admin-age" class="bg-gray-50 dark:bg-gray-900 py-3 sm:py-5">
    <x-admin.alerts :messages="session('error')" :error="true" />
    <x-admin.alerts :messages="session('success')" :error="false" />
    <div class="mx-auto">
        <x-admin.form-update buttonName="Cập nhật loại người dùng" goBack="{{ route('admin.age')}}" route="{{ route('admin.age.update', ['id' => $age->age_id]) }}">
            @method('PATCH')
            <div class="col-span-2">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Loại người dùng</label>
                <input type="text" name="description" id="description" value="{{ $age->description!=''? $age->description : old('description') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 resize-none dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Nhập giá tiền" required></input>
            </div>
        </x-admin.form-update>
    </div>
</section>
@endsection
