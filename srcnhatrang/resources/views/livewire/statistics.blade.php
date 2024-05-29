<div class="container justify-center min-h-screen my-10">
    <div class="mx-auto">
        <h1 class="mb-5 font-bold text-xl">Báo cáo tài chính</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-6 gap-4 mb-10">
            <div class="w-full">
                <label for="year" class="block mb-2 text-sm font-medium text-gray-900">Năm</label>
                <select id="year"
                    class="w-full flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-white bg-black border border-primary-100 rounded-lg focus:ring-2 focus:outline-none focus:ring-primary-100"
                    wire:model.live="year">
                    @foreach ($years as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            </div>

            <div class="w-full">
                <label for="month" class="block mb-2 text-sm font-medium text-gray-900">Tháng</label>
                <select id="month"
                    class="w-full flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-white bg-black border border-primary-100 rounded-lg focus:ring-2 focus:outline-none focus:ring-primary-100"
                    wire:model.live="month">
                    @php
                        $vietnameseMonths = [
                            'Tháng 1',
                            'Tháng 2',
                            'Tháng 3',
                            'Tháng 4',
                            'Tháng 5',
                            'Tháng 6',
                            'Tháng 7',
                            'Tháng 8',
                            'Tháng 9',
                            'Tháng 10',
                            'Tháng 11',
                            'Tháng 12',
                        ];
                    @endphp
                    <option value="0">Tất cả</option>
                    @foreach (range(1, 12) as $index => $month)
                        <option value="{{ $month }}">{{ $vietnameseMonths[$index] }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <h2 class="py-5 font-bold">Tất cả</h2>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            @if (!$litsStatistics->isEmpty())
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tháng
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Năm
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tổng tiền nhận
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tổng tiền chi tiêu
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tổng thú cưng đang ỏ trung tâm
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tổng thú cưng được nhận nuôi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($litsStatistics as $statistics)
                            <tr
                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $statistics->statistic_id }}
                                </td>
                                <td class="px-6 py-4">{{ $statistics->month }}</td>
                                <td class="px-6 py-4">{{ $statistics->year }}</td>
                                <td class="px-6 py-4">{{ $statistics->total_amount_donation }}</td>
                                <td class="px-6 py-4">{{ $statistics->total_money_expenses }}</td>
                                <td class="px-6 py-4">{{ $statistics->total_pets_rescued }}</td>
                                <td class="px-6 py-4">{{ $statistics->total_pest_adoption }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-black">Không có kết quả tìm kiếm phù hợp</p>
            @endif
        </div>

        {{ $litsStatistics->links('vendor.pagination.tailwind') }}

        <h2 class="py-5 font-bold">Chi tiết các khoản thu</h2>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            @if (!$litsMoneyAdoptions->isEmpty())
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tên người quyên góp
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Quỹ quyên góp
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Loại quyên góp
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Số tiền quyên góp
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Ngày quyên góp
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($litsMoneyAdoptions as $moneyAdoption)
                            <tr
                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $moneyAdoption->money_donation_id }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $moneyAdoption->donor->first_name . ' ' . $moneyAdoption->donor->last_name }}
                                </td>
                                <td class="px-6 py-4">{{ $moneyAdoption->fund->title }}</td>
                                <td class="px-6 py-4">
                                    @if ($moneyAdoption->frequency == 0)
                                        1 lần
                                    @elseif($moneyAdoption->frequency == 1)
                                        1 lần/tháng
                                    @else
                                        {{ $moneyAdoption->frequency }}
                                    @endif
                                </td>

                                <td class="px-6 py-4">{{ $moneyAdoption->amount }}</td>
                                <td class="px-6 py-4">{{ $moneyAdoption->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-black">Không có kết quả tìm kiếm phù hợp</p>
            @endif
        </div>
        {{ $litsMoneyAdoptions->links('vendor.pagination.tailwind') }}

        <h2 class="py-5 font-bold">Chi tiết các khoản chi</h2>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            @if (!$litsExpenses->isEmpty())
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Người chi tiêu
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Quỹ chi tiêu
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Chi tiết chi tiêu
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Số tiền chi tiêu
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Ngày chi tiêu
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($litsExpenses as $expense)
                            <tr
                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $expense->expense_id }}
                                </td>
                                <td class="px-6 py-4">SRC Nha Trang</td>
                                <td class="px-6 py-4">{{ $expense->fund->title }}</td>
                                <td class="px-6 py-4">{{ $expense->description }}</td>
                                <td class="px-6 py-4">{{ $expense->amount }}</td>
                                <td class="px-6 py-4">{{ $expense->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-black">Không có kết quả tìm kiếm phù hợp</p>
            @endif
        </div>
        {{ $litsExpenses->links('vendor.pagination.tailwind') }}
    </div>
</div>
