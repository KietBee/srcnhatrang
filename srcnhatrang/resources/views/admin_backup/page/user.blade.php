@extends('admin.layouts.admin')

@section('content')

<section id="admin-user" class="bg-gray-50 dark:bg-gray-900 py-3 sm:py-5">
  
  <x-admin.alerts :messages="session('error')" :error="true" />
  <x-admin.alerts :messages="session('success')" :error="false" />
  <div class="mx-auto">
    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 py-4">
      <div class="w-full md:w-1/2">
          <form id="search-form" class="flex items-center">
              <label for="simple-search" class="sr-only">Tìm kiếm</label>
              <div class="relative w-full">
                  <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                      <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                      </svg>
                  </div>
                  <input type="text" id="search-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Tìm kiếm">
              </div>
          </form>
      </div>
      <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
      <!-- Modal toggle -->
      <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800" type="button">
        Tạo tài khoản
      </button>
      <!-- Main modal -->
      <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
          <div class="relative p-4 w-full max-w-md max-h-full">
              <!-- Modal content -->
              <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                  <!-- Modal header -->
                  <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                      <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Tạo tài khoản mới
                      </h3>
                      <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                          </svg>
                          <span class="sr-only">Đóng cửa số</span>
                      </button>
                  </div>
                  <!-- Modal body -->
                  <form method="POST" action="{{ route('admin.user.create') }}" class="p-4 md:p-5">
                    @csrf
                      <div class="grid gap-4 mb-4 grid-cols-2">
                          <div class="col-span-2 sm:col-span-1">
                            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Họ</label>
                            <input type="text" name="firstName" id="first_name" value="{{ old('firstName') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Nhập họ" required="">
                            <x-input-error :messages="$errors->get('firstName')" class="mt-2" />
                          </div>
                          <div class="col-span-2 sm:col-span-1">
                            <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tên</label>
                            <input type="text" name="lastName" id="last_name" value="{{ old('lastName') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Nhập tên" required="">
                            <x-input-error :messages="$errors->get('lastName')" class="mt-2" />
                          </div>
                          <div class="col-span-2">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="example.@gmail.com" required="">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                          </div>
                          <div class="col-span-2">
                              <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mật khẩu</label>
                              <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Nhập mật khẩu" required="">
                              <x-input-error :messages="$errors->get('password')" class="mt-2" />
                          </div>
                          <div class="col-span-2">
                            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nhập lại mật khẩu</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Nhập lại mật khẩu" required="">
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                          </div>                            
                          <div class="col-span-2 sm:col-span-1">
                              <label for="user_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Loại tài khoản</label>
                              <select id="user_type" name="userType" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                @foreach($listType as $key => $type)
                                  <option value="{{ $type->user_type_id }}" {{ old('userType') == $type->user_type_id ? 'selected' : '' }}>{{ $type->user_type_name }}</option>
                                @endforeach
                              </select>
                              <x-input-error :messages="$errors->get('userType')" class="mt-2" />
                          </div>
                          <div class="flex items-center me-4 self-end col-span-2 sm:col-span-1">
                            <input id="show_password" type="checkbox" value="" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="show_password" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Hiện mật khẩu</label>
                          </div>                            
                      </div>
                      <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                          <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                          Tạo tài khoản
                      </button>
                  </form>
              </div>
          </div>
      </div> 
      <div class="flex items-center space-x-3 w-full md:w-auto">
          <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown" class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" type="button">
              <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-4 w-4 mr-2 text-gray-400" viewbox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
              </svg>
              Bộ lọc
              <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                  <path clip-rule="evenodd" fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
              </svg>
          </button>
          <div id="filterDropdown" class="z-10 hidden w-48 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
            <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">Chọn loại tài khoản</h6>
            <ul id="user-type-dropdown" class="space-y-2 text-sm" aria-labelledby="filterDropdownButton">
              <li class="flex items-center">
                <input id="list-radio-All" type="radio" value="" checked name="type-radio" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                <label for="list-radio-All" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Tất cả ({{ $totalUsers }})</label>
              </li>
              @foreach($listType as $type)
                <li class="flex items-center">
                  <input id="list-radio-{{ $type->user_type_id }}" type="radio" value="{{ $type->user_type_id }}" name="type-radio" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                  <label for="list-radio-ATAD0406" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">{{ $type->user_type_name }} ({{ $type->users->count() }})</label>
                </li>
              @endforeach
            </ul>
              <hr class="mt-3">
              <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">Số kết quả trên 1 trang</h6>
              <ul id="page-size-dropdown" class="space-y-2 text-sm" aria-labelledby="filterDropdownButton">
                  <li class="flex items-center">
                    <input id="list-radio-8" type="radio" value="8" name="list-radio" checked class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                    <label for="list-radio-8" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">8</label>
                  </li>
                  <li class="flex items-center">
                    <input id="list-radio-12" type="radio" value="12" name="list-radio" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                    <label for="list-radio-12" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">12</label>
                  </li>
                  <li class="flex items-center">
                    <input id="list-radio-16" type="radio" value="16" name="list-radio" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                    <label for="list-radio-16" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">16</label>
                  </li>
                  <li class="flex items-center">
                    <input id="list-radio-20" type="radio" value="20" name="list-radio" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                    <label for="list-radio-20" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">20</label>
                  </li>
              </ul>
          </div>
          
      </div>
      <form action="{{ route('admin.export-excel') }}" method="GET">
        @csrf
        <button type="submit" class="flex mx-auto justify-center space-x-3 w-full md:w-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
          Xuất excel 
          <svg class="w-4 h-4 ml-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 15v2a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-2M12 4v12m0-12 4 4m-4-4L8 8"/>
          </svg>
          </button>
      </form>
      </div>
    </div>
      <!-- Start coding here -->
      <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
        <div id="table-content" class="overflow-x-auto">
          <x-admin.table/>
        </div>
        </div>
        <div id="alerts-content" class="text-lg font-semibold text-gray-900 dark:text-white text-center">
        </div>
        <div id="pagination"></div>
      </div>
  </div>

  <div id="popup-delete" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="close-popup absolute -z-10 inset-0 w-full h-full"></div>
    <div id="popup-sub" class="relative p-4 w-full max-w-md max-h-full transform-center-middle">
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700"> 
          </button>
          <button type="button" class="close-popup z-20 absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
          </svg>
          <span class="sr-only">Hủy</span>
          </button>
          <div class="p-4 md:p-5 text-center">
              <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
              </svg>
              <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Bạn có muốn xóa người dùng?</h3>
              <div class="flex justify-center">
                <form id="deleteForm" action="{{ route('admin.user.delete') }}" method="POST">
                  @csrf
                  <input type="hidden" id="deleteId" name="id">
                  <button data-modal-hide="popup-modal" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Xóa
                  </button>
                </form>
                
                <button type="button" class="close-popup py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Hủy</button>
              </div>
          </div>
      </div>
    </div>
        
        <script>
document.addEventListener("DOMContentLoaded", function() {
    document.addEventListener("click", function(event) {
        if (event.target.classList.contains("btnDelete")) {
            var target = event.target.getAttribute("data-target");
            document.getElementById("deleteId").value = target;
            document.getElementById("popup-delete").classList.remove("hidden");
        }

        if (event.target.classList.contains("close-popup")) {
            event.preventDefault(); // Chặn sự kiện mặc định
            var modal = document.getElementById("popup-delete");
            modal.classList.add("hidden");
        }
    });
});

      </script>
      
      
  </section>
@endsection
