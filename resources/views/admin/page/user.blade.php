@extends('admin.layouts.admin')

@section('content')
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
            <div class="overflow-hidden">
              <table
                class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                <thead
                  class="border-b border-neutral-200 font-medium dark:border-white/10">
                  <tr>
                    <th scope="col" class="px-6 py-4">#</th>
                    <th scope="col" class="px-6 py-4">Ảnh đại diện</th>
                    <th scope="col" class="px-6 py-4">Họ</th>
                    <th scope="col" class="px-6 py-4">Tên</th>
                    <th scope="col" class="px-6 py-4">Email</th>
                    <th scope="col" class="px-6 py-4">Xác thực</th>
                    <th scope="col" class="px-6 py-4">SĐT</th>
                    <th scope="col" class="px-6 py-4">Quyền</th>
                    <th scope="col" class="px-6 py-4">Chi tiết</th>
                    <th scope="col" class="px-6 py-4">Chỉnh sửa</th>
                    <th scope="col" class="px-6 py-4">Xóa</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($users as $user)
                  <tr
                    class="border-b border-neutral-200 transition duration-300 ease-in-out hover:bg-neutral-100 dark:border-white/10 dark:hover:bg-neutral-600">
                    <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $user->id }}</td>
                    <td class="whitespace-nowrap px-6 py-4">
                        <img
                            src="{{ $user->avatar }}"
                            alt="avatar"
                            class="relative inline-block h-12 w-12 !rounded-full  object-cover object-center"
                        />
                    </td>
                    <td class="whitespace-nowrap px-6 py-4">{{ $user->first_name }}</td>
                    <td class="whitespace-nowrap px-6 py-4">{{ $user->last_name }}</td>
                    <td class="whitespace-nowrap px-6 py-4">{{ $user->email }}</td>
                    <td class="whitespace-nowrap px-6 py-4">{{ $user->email_verified_at }}</td>
                    <td class="whitespace-nowrap px-6 py-4">{{ $user->phone_number }}</td>
                    <td class="whitespace-nowrap px-6 py-4">{{ $user->user_type_id }}</td>
                    <td class="whitespace-nowrap px-6 py-4"><a href="{{ route('admin.detail-user', ['id' => $user->id]) }}">Xem chi tiết</a>
                    </td>
                    <td class="whitespace-nowrap px-6 py-4">b</td>
                    <td class="whitespace-nowrap px-6 py-4">c</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <!-- Hiển thị số lượng kết quả -->
    <p>Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} results</p>

    <!-- Hiển thị phân trang -->
    <ul class="pagination">
        @if ($users->currentPage() > 1)
            <li><a href="{{ $users->previousPageUrl() }}">Previous</a></li>
        @endif
        
        @for ($i = 1; $i <= $users->lastPage(); $i++)
            <li class="{{ ($users->currentPage() == $i) ? 'active' : '' }}">
                <a href="{{ $users->url($i) }}">{{ $i }}</a>
            </li>
        @endfor
        
        @if ($users->hasMorePages())
            <li><a href="{{ $users->nextPageUrl() }}">Next</a></li>
        @endif
    </ul>
            </div>
          </div>
        </div>
      </div>
      @include('admin.components.pagination')
      {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('admin.profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('admin.profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('admin.profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div> --}}
    
@endsection
