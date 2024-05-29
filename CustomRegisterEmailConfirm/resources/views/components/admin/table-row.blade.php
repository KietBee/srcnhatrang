@props(['rowData', 'imageColumns' => []])

<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
    @foreach($rowData as $index => $data)
        <td class="px-6 py-4 whitespace-nowrap">
            @if (in_array($index, $imageColumns) && $data)
                @if (file_exists(public_path('images/' . $data)))
                    <img src="{{ asset('images/' . $data) }}" alt="ảnh đại diện" class="relative inline-block h-full w-full max-w-12 max-h-12 !rounded-full object-cover object-center">
                @else
                    <img src="{{ asset('images/user.jpg') }}" alt="ảnh đại diện" class="relative inline-block h-full w-full max-w-12 max-h-12 !rounded-full object-cover object-center">
                @endif
            @else
                {{ $data }}
            @endif
        </td>
    @endforeach
</tr>
