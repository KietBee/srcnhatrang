<div class="container justify-center min-h-screen my-10">
    <div class="max-w-lg mx-auto">
        <div class="flex">
            <select
                class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-white bg-black border border-primary-100 rounded-s-lg focus:ring-2 focus:outline-none focus:ring-primary-100"
                wire:model.live="category">
                <option value="">Tất cả danh mục</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->category_id }}">{{ $cat->category_name }}</option>
                @endforeach
            </select>
            <div class="relative w-full">
                <input wire:model.live="search" type="text"
                    class="block p-2.5 w-full z-20 text-sm text-black bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-primary-100 focus:ring-primary-100 focus:border-primary-100"
                    placeholder="Tìm kiếm...">
                <div
                    class="select-none absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-primary-100 rounded-e-lg border border-primary-100">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                    <span class="sr-only">Search</span>
                </div>
            </div>
        </div>
    </div>

    <div class="grid gap-6 grid-cols-1 md:grid-cols-2 xl:grid-cols-3 my-10">
        @if (!$stories->isEmpty())
            @foreach ($stories as $index => $story)
                <div class="card-single h-full bump-up">
                    <a href="{{ route('new-and-post.details', ['id' => $story->story_id]) }}">
                        <div class="bg-black border border-gray-200 rounded-lg shadow h-full">
                            <img class="rounded-t-lg w-full" src="{{ $story->feature_image_url }}"
                                alt="{{ $story->title }}" />
                            <div class="p-5">
                                <h2 class="mb-2 text-2xl font-bold tracking-tight text-white max-content-3">{{ $story->title }}
                                </h2>
                                <p class="mb-3 font-normal text-slate-300 max-content-3">{{ $story->content }}</p>
                                <div class="flex justify-between">
                                    <p class="mb-3 font-normal text-slate-300">{{ $story->approved_at }}</p>
                                    <p class="mb-3 font-normal text-slate-300">
                                        {{ $story->author->last_name . ' ' . $story->author->first_name }}</p>
                                </div>
                                <a href="{{ route('new-and-post.details', ['id' => $story->story_id]) }}"
                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-primary-100 rounded-lg hover:bg-primary-900 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                    Xem thêm
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

    {{ $stories->links('vendor.pagination.tailwind') }}
</div>
