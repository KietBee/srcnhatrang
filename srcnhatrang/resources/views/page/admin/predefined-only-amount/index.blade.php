@extends('layouts.admin')
@section('content')
<section id="admin-predefined-only-amount" class="bg-gray-50 dark:bg-gray-900 py-3 sm:py-5">
    <x-admin.alerts :messages="session('error')" :error="true" />
    <x-admin.alerts :messages="session('success')" :error="false" />

    <div class="mx-auto">
        <div class="w-full py-4 flex flex-shrink-0">
            <x-admin.modal-create buttonName="Thêm giá tiền quyên góp mặc định" route="{{ route('admin.predefined-only-amount.create') }}">
                <div class="col-span-2">
                    <label for="amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Giá tiền (VNĐ)</label>
                    <textarea name="amount" id="amount" rows="5" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 resize-none dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Nhập giá tiền" required>{{ old('amount') }}</textarea>
                    <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                </div>
            </x-admin.modal-create>
        </div>
    </div>

    <livewire:predefined-only-amount-table/>
</section>
@endsection
