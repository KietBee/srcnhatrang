@extends('layouts.admin')
@section('content')
<section id="admin-pet-adoption" class="bg-gray-50 dark:bg-gray-900 py-3 sm:py-5">
    <x-admin.alerts :messages="session('error')" :error="true" />
    <x-admin.alerts :messages="session('success')" :error="false" />
    <div class="mx-auto">
        <x-admin.form-update buttonName="Cập nhật thông tin bài đăng thú cưng cần nhận nuôi" goBack="{{ route('admin.pet-adoption')}}" route="{{ route('admin.pet-adoption.update', ['id' => $pet_adoption->pet_adoption_id]) }}">
            @method('PATCH')
            @csrf
            <div class="col-span-2 sm:col-span-1">
                <label for="pet" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tên thú cưng</label>
                <input type="text" readonly name="pet" id="pet" value="{{ old('pet', $pet_adoption->pet->pet_name) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                <x-input-error :messages="$errors->get('pet')" class="mt-2" />
            </div>  
            <div class="col-span-2">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tiêu đề</label>
                <input type="text" name="title" id="title" value="{{ old('title', $pet_adoption->title) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Nhập tiêu đề" required="">
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
              </div>
              <div class="col-span-2">
                  <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nội dung</label>
                  <textarea name="description" id="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 resize-none" placeholder="Nhập nội dung" required>{{ old('description', $pet_adoption->description) }}</textarea>
                  <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>                          
        </x-admin.form-update>
    </div>
</section>
@endsection
