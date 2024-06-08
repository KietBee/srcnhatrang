@extends('layouts.admin')
@section('content')
<section id="admin-pet-adoption" class="bg-gray-50 dark:bg-gray-900 py-3 sm:py-5">
    <x-admin.alerts :messages="session('error')" :error="true" />
    <x-admin.alerts :messages="session('success')" :error="false" />
    <div class="mx-auto">
        <x-admin.form-update buttonName="Kiểm duyệt yêu cầu nhận nuôi thú cưng" goBack="{{ route('admin.pet-adoption-request') }}" route="{{ route('admin.pet-adoption-request.update', ['id' => $pet_adoption_request->pet_adoption_request_id]) }}">
            @method('PATCH')
            @csrf
            <div class="col-span-2">
                <div class="mb-6">
                    <div class="flex items-center gap-4 my-5">
                        @php
                            $avatarPath = 'images/' . $pet_adoption_request->requester->avatar;
                        @endphp
    
                        @if (Storage::disk('public')->exists($avatarPath))
                            <img src="{{ asset('storage/' . $avatarPath) }}" alt="ảnh đại diện"
                                class="w-10 h-10 rounded-full">
                        @else
                            <img src="{{ asset('images/user.jpg') }}" alt="ảnh đại diện"
                                class="w-10 h-10 rounded-full">
                        @endif
    
                        <div class="font-medium dark:text-white">
                            <div>{{ $pet_adoption_request->requester->first_name . ' ' . $pet_adoption_request->requester->last_name }}
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $pet_adoption_request->created_at }}</div>
                        </div>
                    </div>
                    <label for="content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lý do nhận nuôi</label>
                    <textarea id="content" name="content"
                        class="block  mb-2 resize-none p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-100 focus:border-primary-100"
                        required readonly>{{ $pet_adoption_request->reason_for_adoption }}</textarea>
                        <label for="content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ghi chú của người yêu cầu nhận nuôi</label>
                        <textarea id="content" name="content"
                        class="block resize-none p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-100 focus:border-primary-100"
                        required readonly>{{ $pet_adoption_request->notes }}</textarea>
                </div>
            </div>
        </x-admin.form-update>
        <form action="{{ route('admin.pet-adoption-request.refuse', ['id' => $pet_adoption_request->pet_adoption_request_id]) }}" method="post" class="flex justify-center my-10 w-full">
            @method('PATCH')
            @csrf
            <button type="submit" class="text-white bg-red-700 hover:bg-red-400 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                Từ chối yêu cầu
            </button>
        </form>
    </div>
</section>
@endsection
