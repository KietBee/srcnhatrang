@extends('layouts.admin')
@section('content')
<section id="admin-breed" class="bg-gray-50 dark:bg-gray-900 py-3 sm:py-5">
    <x-admin.alerts :messages="session('error')" :error="true" />
    <x-admin.alerts :messages="session('success')" :error="false" />
    <div class="mx-auto">
        <x-admin.form-update buttonName="Cập nhật giống thú cưng" goBack="{{ route('admin.breed')}}" route="{{ route('admin.breed.update', ['id' => $breed->breed_id]) }}">
            @method('PATCH')
            <div class="col-span-2">
                <label for="breed_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Giống thú cưng</label>
                <input type="text" name="breed_name" id="breed_name" value="{{ $breed->breed_name!=''? $breed->breed_name : old('breed_name') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 rebreed-none dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Nhập giống thú cưng" required></input>
            </div>
        </x-admin.form-update>
    </div>
</section>
@endsection
