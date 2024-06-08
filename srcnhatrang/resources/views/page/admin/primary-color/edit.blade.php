@extends('layouts.admin')
@section('content')
<section id="admin-primary-color" class="bg-gray-50 dark:bg-gray-900 py-3 sm:py-5">
    <x-admin.alerts :messages="session('error')" :error="true" />
    <x-admin.alerts :messages="session('success')" :error="false" />
    <div class="mx-auto">
        <x-admin.form-update buttonName="Cập nhật màu chủ đạo" goBack="{{ route('admin.primary-color')}}" route="{{ route('admin.primary-color.update', ['id' => $primary_color->primary_color_id]) }}">
            @method('PATCH')
            <div class="col-span-2">
                <label for="primary_color_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Màu chủ đạo</label>
                <input type="text" name="primary_color_name" id="primary_color_name" value="{{ $primary_color->primary_color_name!=''? $primary_color->primary_color_name : old('primary_color_name') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 resize-none dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Nhập màu chủ đạo" required></input>
            </div>
        </x-admin.form-update>
    </div>
</section>
@endsection
