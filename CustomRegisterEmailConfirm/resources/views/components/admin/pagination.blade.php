@props(['currentPage', 'totalItems', 'itemsPerPage'])

@php
    $totalPages = ceil($totalItems / $itemsPerPage);
@endphp

<nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">
    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
        Đang hiển thị
        <span class="font-semibold text-gray-900 dark:text-white">{{ min(($currentPage - 1) * $itemsPerPage + 1, $totalItems) }}</span> -
        <span class="font-semibold text-gray-900 dark:text-white">{{ min($currentPage * $itemsPerPage, $totalItems) }}</span>
        của
        <span class="font-semibold text-gray-900 dark:text-white">{{ $totalItems }}</span>
    </span>
    <ul class="inline-flex items-stretch -space-x-px">
        <li>
            <a href="" class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white prev-link">
                <span class="sr-only">Previous</span>
                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
            </a>
        </li>
        @for ($i = 1; $i <= $totalPages; $i++)
            <li>
                <a href="" class="flex items-center justify-center text-sm py-2 px-3 leading-tight pagination-link text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">{{ $i }}</a>
            </li>
        @endfor
        <li>
            <a href="" class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white next-link">
                <span class="sr-only">Next</span>
                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </a>
        </li>
    </ul>
</nav>
