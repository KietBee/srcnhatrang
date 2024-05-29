@extends('layouts.admin')
@section('content')
<section id="admin-pet" class="bg-gray-50 dark:bg-gray-900 py-3 sm:py-5">
    <x-admin.alerts :messages="session('error')" :error="true" />
    <x-admin.alerts :messages="session('success')" :error="false" />

    <div class="mx-auto">
        <div class="w-full py-4 flex flex-shrink-0">
          <x-modal-create buttonName="Thêm thú cưng" route="{{ route('admin.pet.create') }}"> 
            <div class="col-span-2 sm:col-span-1">
              <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Họ</label>
              <input type="text" name="firstName" id="first_name" value="{{ old('firstName') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Nhập họ" required="">
              <x-input-error :messages="$errors->get('firstName')" class="mt-2" />
            </div>
            <div class="col-span-2 sm:col-span-1">
              <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tên</label>
              <input type="text" name="lastName" id="last_name" value="{{ old('lastName') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Nhập tên" required="">
              <x-input-error :messages="$errors->get('lastName')" class="mt-2" />
            </div>
            <div class="col-span-2">
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
              <input type="email" name="email" id="email" value="{{ old('email') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="example.@gmail.com" required="">
              <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div class="col-span-2">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mật khẩu</label>
                <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Nhập mật khẩu" required="">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <div class="col-span-2">
              <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nhập lại mật khẩu</label>
              <input type="password" name="password_confirmation" id="password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Nhập lại mật khẩu" required="">
              <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>                            
            <div class="col-span-2 sm:col-span-1">
                <label for="user_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Loại tài khoản</label>
                <select id="user_type" name="userType" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                  @foreach($listType as $key => $type)
                    <option value="{{ $type->user_type_id }}" {{ old('userType') == $type->user_type_id ? 'selected' : '' }}>{{ $type->user_type_name }}</option>
                  @endforeach
                </select>
                <x-input-error :messages="$errors->get('userType')" class="mt-2" />
            </div>
            <div class="flex items-center me-4 self-end col-span-2 sm:col-span-1">
              <input id="show_password" type="checkbox" value="" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
              <label for="show_password" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Hiện mật khẩu</label>
            </div>    
        </x-modal-create>
    </div>

    <livewire:pet-table/>
</section>
@endsection
