@extends('layouts.app')

@section('content')
    <section>
        <div class="container animation">
            <x-admin.alerts :messages="session('error')" :error="true" />
            <x-admin.alerts :messages="session('success')" :error="false" />
            <div class="grid xl:grid-cols-2 gap-6 my-10">
                <div>
                    <img class="h-full w-full object-cover rounded-lg anima-left" src="{{ $petAdoption->image_feature }}" alt="{{ $petAdoption->title }}">
                </div>
                <form method="post" action="{{ route('pet-adoptions-requests.createRequests') }}" class="anima-right delay-2">
                    @csrf
                    <div class="mb-6">
                        <label for="pet_adoption_name" class="block mb-2 text-sm font-medium text-gray-900">Thú cưng bạn muốn nhận nuôi</label>
                        <input type="hidden" name="petAdoptionID"  value="{{ $petAdoption->pet_adoption_id }}"/>
                        <input type="text" readonly id="pet_adoption_name" name="petAdoptionName" value="{{ $petAdoption->pet->pet_name }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-100 focus:border-primary-100 block w-full p-2.5"/>
                    </div>
                    <div class="mb-6">
                        <label for="reason_for_adoption" class="block mb-2 text-sm font-medium text-gray-900">Lý do nhận nuôi <sup class="text-red-700 font-bold">*</sup></label>
                        <textarea id="reason_for_adoption" rows="4" name="reasonForAdoption"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-100 focus:border-primary-100"
                            placeholder="Nhập lý do nhận nuôi..." required></textarea>
                    </div>
    
                    <div class="mb-6">
                        <label for="notes" class="block mb-2 text-sm font-medium text-gray-900">Ghi chú (nếu có)</label>
                        <textarea id="notes" rows="4" name="notes"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-100 focus:border-primary-100"
                            placeholder="Nhập nội ghi chú..."></textarea>
                    </div>
    
                    <div class="mb-6">
                        <label for="check_token" class="inline-flex items-center">
                            <input id="check_token" name="checkToken" type="checkbox" class="rounded border-gray-300 text-primary-100 shadow-sm focus:ring-primary-500" required="">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Bạn phải chịu trách nhiệm và có nghĩa vụ chăm sóc thú cưng mà mình nhận nuôi') }}<sup class="text-red-700 font-bold">*</sup></span>
                        </label>
                    </div>
            
                    <div class="grid xl:grid-cols-2 gap-6 xl:gap-28">
                        <button type="submit"
                        class="text-white justify-center flex items-center bg-tertiary-400 hover:bg-primary-100 focus:ring-4 focus:ring-primary-100 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 focus:outline-none">
                        Gửi yêu cầu nhận nuôi <svg class="ml-2 w-6 h-6 text-white rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m12 18-7 3 7-18 7 18-7-3Zm0 0v-5"/>
                          </svg>
                          </button>
                        <a href="{{ route('pet-adoptions') }}"
                        class="text-white justify-center flex items-center bg-primary-200 hover:bg-primary-600 focus:ring-4 focus:ring-primary-100 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 focus:outline-none">
                        Nhận nuôi thú cưng khác <svg class="ml-2 w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4"/>
                          </svg>
                          </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
