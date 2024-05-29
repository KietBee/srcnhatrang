@extends('layouts.admin')
@section('content')
<section id="admin-QA" class="bg-gray-50 dark:bg-gray-900 py-3 sm:py-5">
    <x-admin.alerts :messages="session('error')" :error="true" />
    <x-admin.alerts :messages="session('success')" :error="false" />
    {{-- <div class="mx-auto">
        <div class="w-full py-4 flex flex-shrink-0">
          <x-modal-create buttonName="Thêm câu hỏi đáp nhanh" route="{{ route('admin.QA.update', ['id' => $QA->QA_ID]) }}">
            <div class="col-span-2">
                <label for="question" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Câu hỏi</label>
                <textarea name="question" id="question" rows="5" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 resize-none dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Nhập câu hỏi" required>{{ $QA->question!=''? $QA->question : old('question') }}</textarea>
                <x-input-error :messages="$errors->get('question')" class="mt-2" />
            </div>
            <div class="col-span-2">
                <label for="answer" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Câu trả lời</label>
                <textarea name="answer" id="answer" rows="5" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 resize-none dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Nhập câu trả lời" required>{{ $QA->answer!=''? $QA->answer : old('answer') }}</textarea>
                <x-input-error :messages="$errors->get('answer')" class="mt-2" />
            </div>
        </x-modal-create>
    </div> --}}
    <div class="mx-auto">
        <x-admin.form-update buttonName="Cập nhật câu hỏi đáp nhanh" goBack="{{ route('admin.QA')}}" route="{{ route('admin.QA.update', ['id' => $QA->QA_ID]) }}">
            @method('PATCH')
            <div class="col-span-2">
                <label for="question" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Câu hỏi</label>
                <textarea name="question" id="question" rows="5" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 resize-none dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Nhập câu hỏi" required>{{ $QA->question!=''? $QA->question : old('question') }}</textarea>
                <x-input-error :messages="$errors->get('question')" class="mt-2" />
            </div>
            <div class="col-span-2">
                <label for="answer" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Câu trả lời</label>
                <textarea name="answer" id="answer" rows="5" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 resize-none dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Nhập câu trả lời" required>{{ $QA->answer!=''? $QA->answer : old('answer') }}</textarea>
                <x-input-error :messages="$errors->get('answer')" class="mt-2" />
            </div>
        </x-admin.form-update>
        {{-- <div class="w-full py-4 flex flex-shrink-0">
            <x-admin.modal-create buttonName="Thêm câu hỏi đáp nhanh" route="{{ route('admin.QA.create') }}">
                <div class="col-span-2">
                    <label for="question" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Câu hỏi</label>
                    <textarea name="question" id="question" rows="5" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 resize-none dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Nhập câu hỏi" required>{{ old('question') }}</textarea>
                    <x-input-error :messages="$errors->get('question')" class="mt-2" />
                </div>
                <div class="col-span-2">
                    <label for="answer" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Câu trả lời</label>
                    <textarea name="answer" id="answer" rows="5" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 resize-none dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Nhập câu trả lời" required>{{ old('answer') }}</textarea>
                    <x-input-error :messages="$errors->get('answer')" class="mt-2" />
                </div>
            </x-admin.modal-create>
        </div> --}}
    </div>
</section>
@endsection
