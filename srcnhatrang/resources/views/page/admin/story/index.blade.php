@extends('layouts.admin')
@section('content')
    <section id="admin-story" class="bg-gray-50 dark:bg-gray-900 py-3 sm:py-5">
        <x-admin.alerts :messages="session('error')" :error="true" />
        <x-admin.alerts :messages="session('success')" :error="false" />
        <div class="mx-auto">
            <div class="w-full py-4 flex flex-shrink-0">
                <x-admin.modal-create buttonName="Thêm tin tức mới" route="{{ route('admin.story.create') }}">
                    <div class="mb-6 col-span-2">
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Tiêu đề</label>
                        <input type="text" id="title" name="title"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Nhập tiêu đề bài viết" required />
                    </div>
                    <div class="mb-6 col-span-2">
                        <label for="content" class="block mb-2 text-sm font-medium text-gray-900">Nội dung</label>
                        <textarea id="content" rows="4" name="content"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Nhập nội dung bài viết..." required></textarea>
                    </div>
            
                    <div class="mb-6 col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Tải hình
                            ảnh</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            aria-describedby="file_input_help" id="file_input" type="file" name="featureImage" required>
                        <p class="mt-1 mb-6 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or GIF
                            (Kích thước tối đa.
                            800x400px).</p>
                    </div>
                </x-admin.modal-create>
            </div>
            <livewire:story-table />
    </section>
@endsection
