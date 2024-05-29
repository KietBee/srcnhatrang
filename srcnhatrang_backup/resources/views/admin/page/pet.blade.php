@extends('admin.layouts.admin')

@section('content')
<div class="container mx-auto my-10 px-10">
    <div x-data="{ showModal1: false, showModal2: false, showModal3: false, id: '', name: '', status: ''}">
        <div class="flex">
            <button @click="showModal1 = true" class="w-[10%] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                Add new
            </button>
            <div class="w-[80%] text-center text-5xl font-bold">Pet - SRC Dashboards</div>
        </div>
        <!-- Modal -->
        <div x-show="showModal1" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="w-[400px] bg-white p-6 max-w-lg mx-auto rounded-lg shadow-lg" @click.away="showModal1 = false">
            <form class="relative" method="post">
                <div>
                    <p class="text-3xl font-bold pb-7">Add new brand</p>
                </div>
                <div class="mb-5">
                    <label for="brand" class="block mb-2 text-sm font-medium text-gray-900">Brand</label>
                    <input type="text" id="brand" name="brand" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                </div>
                <div class="mb-5">
                    <label for="project_ID" class="block mb-2 text-sm font-medium text-gray-900">Project ID</label>
                    <input type="text" id="project_ID" name="project_ID" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                </div>
                <div class="mb-5">
                    <label for="query_ID" class="block mb-2 text-sm font-medium text-gray-900">Query ID</label>
                    <input type="text" id="query_ID" name="query_ID" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                </div>
                <div class="mb-5 text-lg">
                    <label for="status" class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                    <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="1">Publish</option>
                        <option value="0">Unpublish</option> 
                    </select>
                </div>
                <button type="submit" name="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                Submit
                </button>
                <button @click="showModal1 = false" type="button" class="absolute top-0 end-0.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center " data-modal-hide="popup-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </form>
            </div>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-10">
            <table class="w-full text-sm text-left rtl:text-right">
                <thead class="text-xs  uppercase bg-white border-b border-gray-200">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Ảnh
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tên
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Giống
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Giới tính
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Ngày nhận
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Chi tiết
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Sửa
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Xóa
                        </th>
                    </tr>
                </thead>
                <tbody class="field-value">
                    @foreach($listPet as $pet)
                    <tr class="bg-white border-b border-gray-200 hover:bg-gray-200">
                        <td class="px-6 py-4">{{ $pet->pet_id }}</td>
                        <td class="whitespace-nowrap px-6 py-4">
                            @if ($pet->petImage->isNotEmpty())
                                <img
                                    src="{{ $pet->petImage->first()->pet_image }}"
                                    alt=""
                                    class="relative inline-block h-12 w-12 !rounded-full  object-cover object-center"
                                />
                            @endif
                            <img/>
                        </td>
                        <td class="px-6 py-4">{{ $pet->pet_name }}</td>
                        <td class="px-6 py-4">{{ $pet->breed->breed_name }}</td>
                        <td class="px-6 py-4">
                            @if($pet->gender == 0)
                                Đực
                            @else
                                Cái
                            @endif
                        </td>
                        
                        <td class="px-6 py-4">{{ $pet->rescued_at }}</td>
                        <td class="px-6 py-4 hover:cursor-pointer text-red-800 hover:text-red-600">
                            <svg  x-on:click="showModal2 = true; id = '.$value->ID.'; name = \''.$value->brand.'\';" class="mx-auto feather feather-trash-2" fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                        </td>
                        <td class="px-6 py-4 hover:cursor-pointer text-blue-800 hover:text-blue-600">
                            <svg x-bind:data-id="'.$value->ID.'" class="value-id mx-auto feather feather-info" fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="16" y2="12"/><line x1="12" x2="12.01" y1="8" y2="8"/></svg>
                        </td>
                        <td class="px-6 py-4 hover:cursor-pointer text-blue-800 hover:text-blue-600">
                            <svg x-bind:data-id="'.$value->ID.'" class="value-id mx-auto feather feather-info" fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="16" y2="12"/><line x1="12" x2="12.01" y1="8" y2="8"/></svg>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div x-show="showModal2" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="w-[350px] bg-white p-6 max-w-lg mx-auto rounded-lg shadow-lg" @click.away="showModal2 = false">
            <form class="relative" method="POST">
                <div>
                    <p class="text-3xl font-bold pb-2">Confirm</p>
                </div>
                <div>
                    <p>
                        Are you sure you want delete field value? <br>
                        ID: <span x-text="id"></span><br>
                        Name: <span x-text="name"></span>
                    </p>
                    <input name="id" type="text" hidden x-bind:value="id">
                </div>
                <div class="flex mt-4">
                    <button type="submit" name="delete" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5">
                    Delete
                    </button>
                    <button @click="showModal2 = false" type="button" class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm ml-auto px-5 py-2.5">
                    Cancel
                    </button>
                </div>
            </form>
            </div>
        </div>
        <div x-show="showModal3" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="w-[300px] bg-white p-6 max-w-lg mx-auto rounded-lg shadow-lg" @click.away="showModal3 = false">
            <form class="relative" method="POST">
                <div>
                    <p class="text-3xl font-bold pb-2">Confirm</p>
                </div>
                <div> 
                    <p>
                        Change status field value with ID: <span x-text="id"></span>
                    </p>
                    <input name="id" type="text" hidden x-bind:value="id">
                    <input name="status" type="text" hidden x-bind:value="status">
                </div>
                <div class="flex mt-4">
                    <button type="submit" name="ChangeStatus" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5">
                    Confirm
                    </button>
                    <button @click="showModal3 = false" type="button" class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm ml-auto px-5 py-2.5">
                    Cancel
                    </button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection
