@extends('layouts.admin')
@section('content')
    <section id="admin-feedback" class="bg-gray-50 dark:bg-gray-900 py-3 sm:py-5">
        <x-admin.alerts :messages="session('error')" :error="true" />
        <x-admin.alerts :messages="session('success')" :error="false" />
        <div class="grid xl:grid-cols-2 gap-6 my-10">
            <div>
                <div class="mb-6">
                    <div class="flex items-center gap-4 my-5">
                        @php
                            $avatarPath = 'images/' . $feedback->senderUser->avatar;
                        @endphp

                        @if (Storage::disk('public')->exists($avatarPath))
                            <img src="{{ asset('storage/' . $avatarPath) }}" alt="ảnh đại diện"
                                class="w-10 h-10 rounded-full">
                        @else
                            <img src="{{ asset('images/user.jpg') }}" alt="ảnh đại diện"
                                class="w-10 h-10 rounded-full">
                        @endif

                        <div class="font-medium dark:text-white">
                            <div>{{ $feedback->senderUser->first_name . ' ' . $feedback->senderUser->last_name }}
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $feedback->created_at }}</div>
                        </div>
                    </div>
                    <textarea id="content" name="content"
                        class="block resize-none p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-100 focus:border-primary-100"
                        required readonly>{{ $feedback->content }}</textarea>
                </div>
            </div>
            <form method="post" action="{{ route('admin.feedback.update', ['id' => $feedback->feedback_id]) }}"
                class="anima-right delay-2">
                @csrf
                @method('PATCH')
                <div class="mb-6">
                    <label for="response" class="block mb-2 text-sm font-medium text-gray-900">
                        Nội dung trả lời<sup class="text-red-700 font-bold">*</sup>
                    </label>
                    <textarea id="response" rows="10" name="response"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-100 focus:border-primary-100"
                        placeholder="Nhập nội dung trả lời..." required></textarea>
                </div>
                <div>
                    <button type="submit"
                        class="text-white justify-center flex items-center bg-tertiary-400 hover:bg-primary-100 focus:ring-4 focus:ring-primary-100 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 focus:outline-none">
                        Gửi mail <svg class="ml-2 w-6 h-6 text-white rotate-90" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m12 18-7 3 7-18 7 18-7-3Zm0 0v-5" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
