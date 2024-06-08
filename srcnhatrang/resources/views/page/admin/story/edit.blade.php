@extends('layouts.admin')
@section('content')
<section id="admin-story" class="bg-gray-50 dark:bg-gray-900 py-3 sm:py-5">
    <x-admin.alerts :messages="session('error')" :error="true" />
    <x-admin.alerts :messages="session('success')" :error="false" />
    <div class="mx-auto">
        <x-admin.form-update buttonName="Kiểm duyệt bài viết" goBack="{{ route('admin.story')}}" route="{{ route('admin.story.update', ['id' => $story->story_id]) }}">
            @method('PATCH')
            @csrf
            <div class="col-span-2">
                <div class="mb-6 grid grid-cols-3 gap-10 items-center">
                    <div class="col-span-3 xl:col-span-1">
                        <div class="flex items-center gap-4 my-5">
                            @php
                                $avatarPath = 'images/' . $story->author->avatar;
                            @endphp
        
                            @if (Storage::disk('public')->exists($avatarPath))
                                <img src="{{ asset('storage/' . $avatarPath) }}" alt="ảnh đại diện"
                                    class="w-10 h-10 rounded-full">
                            @else
                                <img src="{{ asset('images/user.jpg') }}" alt="ảnh đại diện"
                                    class="w-10 h-10 rounded-full">
                            @endif
        
                            <div class="font-medium dark:text-white">
                                <div>{{ $story->author->first_name . ' ' . $story->author->last_name }}
                                </div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">{{ $story->created_at }}</div>
                            </div>
                        </div>
                        <div>
                            @php
                                $feature = 'images/' . $story->feature_image_url	;
                            @endphp
        
                            @if (Storage::disk('public')->exists($feature))
                                <img src="{{ asset('storage/' . $feature) }}" alt="ảnh bài viết"
                                    class="w-full rounded-lg">
                            @else
                                <img src="{{ asset('images/default.jpg') }}" alt="ảnh bài viết"
                                    class="w-full rounded-lg">
                            @endif
                        </div>
                    </div>
                    <div class="col-span-3 xl:col-span-2">
                        <label for="content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tiêu đề bài viết</label>
                    <textarea id="content" name="content"
                        class="block  mb-2 resize-none p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-100 focus:border-primary-100"
                        required readonly>{{ $story->title }}</textarea>
                        <label for="content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nội dung</label>
                        <textarea id="content" name="content"
                        class="block resize-none p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-100 focus:border-primary-100"
                        required readonly>{{ $story->content }}</textarea>
                    </div>
                </div>
            </div>
        </x-admin.form-update>
        <form action="{{ route('admin.story.refuse', ['id' => $story->story_id]) }}" method="post" class="flex justify-center my-10 w-full">
            @method('PATCH')
            @csrf
            <button type="submit" class="text-white bg-red-700 hover:bg-red-400 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                Xóa bài viết
            </button>
        </form>
    </div>
</section>
@endsection
