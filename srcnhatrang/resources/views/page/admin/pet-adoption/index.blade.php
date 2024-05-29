@extends('layouts.admin')
@section('content')
<section id="admin-pet-adoption" class="bg-gray-50 dark:bg-gray-900 py-3 sm:py-5">
    <x-admin.alerts :messages="session('error')" :error="true" />
    <x-admin.alerts :messages="session('success')" :error="false" />
    
    <div class="mx-auto">
        <div class="w-full py-4 flex flex-shrink-0">
          <x-modal-create buttonName="Thêm thú cưng nhận nuôi" route="{{ route('admin.pet-adoption.create') }}"> 
            <div class="col-span-2">
              <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tiêu đề</label>
              <input type="text" name="title" id="title" value="{{ old('title') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Nhập tiêu đề" required="">
              <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>
            <div class="col-span-2">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nội dung</label>
                <textarea name="description" id="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 resize-none dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Nhập nội dung" required>{{ old('description') }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
              </div>                          
            <div class="col-span-2 sm:col-span-1">
                <label for="pet" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Chọn thú cưng</label>
                <select id="pet" name="pet" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                  @foreach($listPets as $key => $item)
                    <option value="{{ $item->pet_id }}" {{ old('pet') == $item->pet_id ? 'selected' : '' }}>{{ $item->pet_name }}</option>
                  @endforeach
                </select>
                <x-input-error :messages="$errors->get('pet')" class="mt-2" />
            </div>  
        </x-modal-create>
    </div>

    <livewire:pet-adoption-table/>
</section>
@endsection
