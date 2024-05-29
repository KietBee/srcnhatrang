@extends('layouts.app')

@section('content')
    <section class="my-10">
        <div class="container animation">
            <x-admin.alerts :messages="session('error')" :error="true" />
            <x-admin.alerts :messages="session('success')" :error="false" />
            <div class="grid xl:grid-cols-2 gap-6 my-10">
                <div>
                    <img class="h-full w-full object-cover object-center rounded-lg anima-left" src="{{ asset('storage/images/app/home/Feedback.png') }}" alt="">
                </div>
                <form method="post" action="{{ route('feedbacks.create') }}" class="anima-right delay-2">
                    @csrf
                    <div class="mb-6">
                        <label for="content" class="block mb-2 text-sm font-medium text-gray-900">Nội dung phản hồi<sup class="text-red-700 font-bold">*</sup></label>
                        <textarea id="content" rows="10" name="content"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-100 focus:border-primary-100"
                            placeholder="Nhập nội dung phản hồi..." required></textarea>
                    </div>
            
                    <div class="grid xl:grid-cols-2 gap-6 xl:gap-28">
                        <button type="submit"
                        class="text-white justify-center flex items-center bg-tertiary-400 hover:bg-primary-100 focus:ring-4 focus:ring-primary-100 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 focus:outline-none">
                        Gửi phản hồi <svg class="ml-2 w-6 h-6 text-white rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m12 18-7 3 7-18 7 18-7-3Zm0 0v-5"/>
                          </svg>
                          </button>
                        <a href="{{ route('home') }}"
                        class="text-white justify-center flex items-center bg-primary-200 hover:bg-primary-600 focus:ring-4 focus:ring-primary-100 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 focus:outline-none">
                        Về trang chủ <svg class="ml-2 w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4"/>
                          </svg>
                          </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
