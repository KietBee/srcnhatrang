<div class="container justify-center min-h-screen my-10">
    <div class="mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-6 gap-4 mb-10">
            <div class="w-full">
                <label for="species" class="block mb-2 text-sm font-medium text-gray-900">Loài</label>
                <select id="species"
                    class="w-full flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-white bg-black border border-primary-100 rounded-lg focus:ring-2 focus:outline-none focus:ring-primary-100"
                    wire:model.live="specie">
                    <option value="">Tất cả danh mục</option>
                    @foreach ($species as $item)
                        <option value="{{ $item->specie_id }}">{{ $item->specie_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-full">
                <label for="breeds" class="block mb-2 text-sm font-medium text-gray-900">Giống</label>
                <select id="breeds"
                    class="w-full flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-white bg-black border border-primary-100 rounded-lg focus:ring-2 focus:outline-none focus:ring-primary-100"
                    wire:model.live="breed">
                    <option value="">Tất cả danh mục</option>
                    @foreach ($breeds as $item)
                        <option value="{{ $item->breed_id }}">{{ $item->breed_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-full">
                <label for="primary_colors" class="block mb-2 text-sm font-medium text-gray-900">Màu chủ đạo</label>
                <select id="primary_colors"
                    class="w-full flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-white bg-black border border-primary-100 rounded-lg focus:ring-2 focus:outline-none focus:ring-primary-100"
                    wire:model.live="primaryColor">
                    <option value="">Tất cả danh mục</option>
                    @foreach ($primaryColors as $item)
                        <option value="{{ $item->primary_color_id }}">{{ $item->primary_color_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-full">
                <label for="ages" class="block mb-2 text-sm font-medium text-gray-900">Độ tuổi</label>
                <select id="ages"
                    class="w-full flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-white bg-black border border-primary-100 rounded-lg focus:ring-2 focus:outline-none focus:ring-primary-100"
                    wire:model.live="age">
                    <option value="">Tất cả danh mục</option>
                    @foreach ($ages as $item)
                        <option value="{{ $item->age_id }}">{{ $item->description }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-full">
                <label for="sizes" class="block mb-2 text-sm font-medium text-gray-900">Kích thước</label>
                <select id="sizes"
                    class="w-full flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-white bg-black border border-primary-100 rounded-lg focus:ring-2 focus:outline-none focus:ring-primary-100"
                    wire:model.live="size">
                    <option value="">Tất cả danh mục</option>
                    @foreach ($sizes as $item)
                        <option value="{{ $item->size_id }}">{{ $item->description }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-full">
                <label for="genders" class="block mb-2 text-sm font-medium text-gray-900">Giới tính</label>
                <select id="genders"
                    class="w-full flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-white bg-black border border-primary-100 rounded-lg focus:ring-2 focus:outline-none focus:ring-primary-100"
                    wire:model.live="gender">
                    <option value="">Tất cả danh mục</option>
                    <option value="0">Giống đực</option>
                    <option value="1">Giống cái</option>
                </select>
            </div>
        </div>
        <div class="relative w-full">
            <input wire:model.live="search" type="text"
                class="block p-2.5 w-full z-20 text-sm text-black bg-gray-50 rounded-lg border-gray-50 border-2 border-primary-100 focus:ring-primary-100 focus:border-primary-100"
                placeholder="Tìm kiếm...">
            <div
                class="select-none absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-primary-100 rounded-lg border border-primary-100">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
                <span class="sr-only">Search</span>
            </div>
        </div>
    </div>

    <div class="grid gap-6 grid-cols-1 md:grid-cols-2 xl:grid-cols-3 my-10">
        @if (!$litsPetAdoptions->isEmpty())
            @foreach ($litsPetAdoptions as $index => $petAdoptions)
                <div class="card-single h-full bump-up">
                    <a href="{{ route('pet-adoptions.details', ['id' => $petAdoptions->pet_adoption_id]) }}">
                        <div class="bg-black border border-gray-200 rounded-lg shadow h-full">
                            <img class="rounded-t-lg w-full" src="{{ $petAdoptions->image_feature }}"
                                alt="{{ $petAdoptions->title }}" />
                            <div class="p-5">
                                <h2 class="mb-2 text-2xl font-bold tracking-tight text-white max-content-3">{{ $petAdoptions->title }}
                                </h2>
                                <p class="mb-3 font-normal text-slate-300 max-content-3">{{ $petAdoptions->description }}</p>
                                <p class="mb-3 font-normal text-slate-300">{{ $petAdoptions->created_at }}</p>
                                <a href="{{ route('pet-adoptions.details', ['id' => $petAdoptions->pet_adoption_id]) }}"
                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-primary-100 rounded-lg hover:bg-primary-900 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                    Xem thông tin chi tiết
                                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        @else
            <p class="text-black">Không có kết quả tìm kiếm phù hợp</p>
        @endif
    </div>

    {{ $litsPetAdoptions->links('vendor.pagination.tailwind') }}
</div>
