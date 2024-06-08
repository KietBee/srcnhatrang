@extends('layouts.admin')
@section('content')
<section id="admin-expense" class="bg-gray-50 dark:bg-gray-900 py-3 sm:py-5">
    <x-admin.alerts :messages="session('error')" :error="true" />
    <x-admin.alerts :messages="session('success')" :error="false" />

    <div class="mx-auto">
        <div class="w-full py-4 flex flex-shrink-0">
            <x-admin.modal-create buttonName="Tạo phiếu chi" route="{{ route('admin.expense.create') }}">
                <div class="col-span-2">
                    <label for="fund" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Loại tài khoản</label>
                    <select id="fund" name="fund" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    @foreach($listFunds as $key => $type)
                        <option value="{{ $type->fund_id }}" {{ old('fund') == $type->fund_id ? 'selected' : '' }}>{{ $type->title }}</option>
                    @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('fund')" class="mt-2" />
                </div>
                <div class="col-span-2">
                    <label for="amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Số tiền chi tiêu</label>
                    <input type="number" min="0" name="amount" id="amount" rows="5" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 resize-none dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Nhập giá tiền chi tiêu" value="{{ old('amount') }}" required></input>
                    <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                </div>
                <div class="col-span-2">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nội dung chi tiêu</label>
                    <textarea name="description" id="description" rows="5" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 resize-none dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Nhập nội dung chi tiêu" required>{{ old('description') }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
            </x-admin.modal-create>
        </div>
    </div>

    <livewire:expense-table/>
</section>
@endsection
