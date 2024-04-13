@extends('layouts.guest')
@section('content')
  <div class="container font-[sans-serif] bg-primary-400 text-gray-800 max-w-7xl flex items-center mx-auto md:h-screen p-4">
    <div class="grid md:grid-cols-3 items-center shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] rounded-xl overflow-hidden">
      <div class="max-md:order-1 flex flex-col justify-center space-y-16 max-md:mt-16 min-h-full bg-gradient-to-r from-gray-900 to-gray-700 lg:px-8 px-4 py-4">
        <div>
          <h4 class="text-white text-lg font-semibold">Create Your Account</h4>
          <p class="text-[13px] text-white mt-2">Welcome to our registration page! Get started by creating your account.</p>
        </div>
        <div>
          <h4 class="text-white text-lg font-semibold">Simple & Secure Registration</h4>
          <p class="text-[13px] text-white mt-2">Our registration process is designed to be straightforward and secure. We prioritize your privacy and data security.</p>
        </div>
      </div>
      <form method="POST" action="{{ route('register') }}" class="form-control md:col-span-2 w-full py-6 px-6 sm:px-16">
        @csrf
        <div class="mb-6">
          <h3 class="text-2xl font-bold">Create an account</h3>
        </div>
        <!-- Firts Name -->
        <div class="group-box mt-4">
          <x-text-input id="firts_name" class="block mt-1 w-full" type="text" name="firts_name" :value="old('firts_name')" required autofocus autocomplete="firts_name" />
          <x-input-label for="firts_name" :value="__('Firts Name')" />
          <x-input-error :messages="$errors->get('firts_name')" class="mt-2" />
        </div>
        <!-- Last Name -->
        <div class="group-box mt-4">
          <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autofocus autocomplete="last_name" />
          <x-input-label for="last_name" :value="__('Last Name')" />
          <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="group-box mt-4">
          <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
          <x-input-label for="email" :value="__('Email')" />
          <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <!-- Phone Number -->
        <div class="group-box mt-4">
          <x-text-input id="phone_number" class="block mt-1 w-full" type="tel" name="phone_number" :value="old('phone_number')" required autofocus autocomplete="phone_number" />
          <x-input-label for="phone_number" :value="__('Phone Number')" />
          <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="group-box mt-4">
          <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
          <x-input-label for="password" :value="__('Password')" />
          <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="group-box mt-4">
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
          <button type="submit" class="py-3 px-4 text-sm font-semibold rounded text-white bg-red-600 hover:bg-gray-800 focus:outline-none w-full items-center border border-transparent tracking-widest focus:bg-gray-700 active:bg-gray-900 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
            Bước tiếp theo
          </button>
        </div>
        <p class="text-sm mt-6 text-center">Already have an account? <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:underline ml-1">Login here</a></p>
      </form>
    </div>
  </div>
@endsection
