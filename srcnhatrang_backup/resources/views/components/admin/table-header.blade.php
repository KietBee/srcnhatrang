@props(['headers'])

<tr>
    @foreach ($headers as $header)
        <th scope="col" class="px-6 py-3" data-sort-by="{{ $header['sortBy'] }}">
            <div class="flex items-center @if ($header['center']) justify-center @endif">
                {{ $header['label'] }}
                @if ($header['sortable'])
                    <a href="#" class="sort-trigger">
                        <svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                        </svg>
                    </a>
                @endif
            </div>
        </th>
    @endforeach
</tr>

