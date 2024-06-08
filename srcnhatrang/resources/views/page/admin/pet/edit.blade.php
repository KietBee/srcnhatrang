@extends('layouts.admin')
@section('content')
<section id="admin-pet" class="bg-gray-50 dark:bg-gray-900 py-3 sm:py-5">
    <x-admin.alerts :messages="session('error')" :error="true" />
    <x-admin.alerts :messages="session('success')" :error="false" />
    <div class="mx-auto">
        <x-admin.form-update buttonName="Cập nhật thông tin thú cưng" goBack="{{ route('admin.pet')}}" route="{{ route('admin.pet.update', ['id' => $pet->pet_id]) }}">
            @method('PATCH')
            @csrf
            <div class="col-span-2">
                <label for="pet_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tên thú cưng</label>
                <input type="text" name="pet_name" id="pet_name" value="{{ old('pet_name', $pet->pet_name) }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Nhập tên thú cưng" required>
                <x-input-error :messages="$errors->get('pet_name')" class="mt-2" />
            </div>
            <div class="col-span-2">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Giới tính</label>
                <div class="flex">
                    <div class="flex items-center me-4">
                        <input id="female" type="radio" value="0" name="gender" {{ old('gender', $pet->gender) == 1 ? 'checked' : '' }}
                            class="w-4 h-4 text-primary-100 bg-gray-100 border-gray-300">
                        <label for="female" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Giống đực</label>
                    </div>
                    <div class="flex items-center me-4">
                        <input id="male" type="radio" value="1" name="gender" {{ old('gender', $pet->gender) == 0 ? 'checked' : '' }}
                            class="w-4 h-4 text-primary-100 bg-gray-100 border-gray-300">
                        <label for="male" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Giống cái</label>
                    </div>
                </div>
            </div>
            <div class="col-span-2 xl:col-span-1">
                <label for="primary_color_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Màu sắc</label>
                <select id="primary_color_id" name="primary_color_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    @foreach ($listColors as $key => $type)
                        <option value="{{ $type->primary_color_id }}" {{ old('primary_color_id', $pet->primary_color_id) == $type->primary_color_id ? 'selected' : '' }}>
                            {{ $type->primary_color_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-2 xl:col-span-1">
                <label for="breed_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Giống</label>
                <select id="breed_id" name="breed_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    @foreach ($listBreeds as $key => $type)
                        <option value="{{ $type->breed_id }}" {{ old('breed_id', $pet->breed_id) == $type->breed_id ? 'selected' : '' }}>
                            {{ $type->breed_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-2 xl:col-span-1">
                <label for="age_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tuổi</label>
                <select id="age_id" name="age_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    @foreach ($listAges as $key => $type)
                        <option value="{{ $type->age_id }}" {{ old('age_id', $pet->age_id) == $type->age_id ? 'selected' : '' }}>
                            {{ $type->description }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-2 xl:col-span-1">
                <label for="size_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kích thước</label>
                <select id="size_id" name="size_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    @foreach ($listSizes as $key => $type)
                        <option value="{{ $type->size_id }}" {{ old('size_id', $pet->size_id) == $type->size_id ? 'selected' : '' }}>
                            {{ $type->description }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-2">
                <label for="health_status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tình trạng sức khỏe</label>
                <textarea name="health_status" id="health_status"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Nhập tình trạng sức khỏe" required>{{ old('health_status', $pet->health_status) }}</textarea>
                <x-input-error :messages="$errors->get('health_status')" class="mt-2" />
            </div>
            <div class="col-span-2">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mô tả chi tiết</label>
                <textarea name="description" id="description"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Nhập mô tả chi tiết" required>{{ old('description', $pet->description) }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>
        </x-admin.form-update>
    </div>
</section>
@endsection
