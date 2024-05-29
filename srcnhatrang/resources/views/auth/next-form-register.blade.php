<div class="flex gap-5 mt-4">
    <div class='group-box w-1/3'>
      <select name="province" id="province" class="w-full">
          <option value="">Chọn Tỉnh/Thành phố</option>
          @foreach ($provinces as $province)
              <option value="{{ $province->id }}" {{ old('province') == $province->id ? 'selected' : '' }}>
                  {{ $province->name }}
              </option>
          @endforeach
      </select>
    </div>
    <div class='group-box w-1/3'>
      <select name="district" id="district" class="w-full">
        <option value="">Chọn Quận/Huyện</option>
      </select>
    </div>
    <div class='group-box w-1/3'>
      <select name="ward" id="ward" class="w-full">
        <option value="">Chọn Phường/Xã</option>
      </select>
    </div>
  </div>

  <div class="group-box mt-4">
    <x-text-input id="address_description" class="block mt-1 w-full" type="text" name="address_description" :value="old('address_description')" required autofocus autocomplete="address_description" />
    <x-input-label for="address_description" :value="__('Tên đường, tòa nhà, số nhà')" />
    <x-input-error :messages="$errors->get('address_description')" class="mt-2" />
  </div>

  <div class="flex items-center mt-4">
    <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 shrink-0 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" />
    <label for="remember-me" class="ml-3 block text-sm">
      I accept the <a href="javascript:void(0);" class="text-blue-600 font-semibold hover:underline ml-1">Terms and Conditions</a>
    </label>
  </div>