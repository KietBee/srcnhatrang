<div class="container justify-center min-h-screen my-10">
    <div class="mx-auto">
        <h1 class="mb-5 font-bold text-xl">Báo cáo tài chính</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-6 gap-4 mb-10">
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
                    @foreach (range(1, 12) as $index => $month)
                        <option value="{{ $month }}">{{ $vietnameseMonths[$index] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="w-full md:col-span-2">
                <label for="fund" class="block mb-2 text-sm font-medium text-gray-900">Quỹ</label>
                <select id="fund"
                    class="w-full flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-left text-white bg-black border border-primary-100 rounded-lg focus:ring-2 focus:outline-none focus:ring-primary-100"
                    wire:model.live="fund">
                    @foreach ($funds as $fund)
                        <option value="{{ $fund->fund_id }}">{{ $fund->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="w-full flex items-end justify-end">
                <button id="chart-btn"
                    class="inline-flex px-5 py-3 text-white bg-primary-950 hover:bg-primary-100 borde rounded-md">
                    <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v15a1 1 0 0 0 1 1h15M8 16l2.5-5.5 3 3L17.273 7 20 9.667"/>
                    </svg>                      
                    Tạo biểu đồ
                </button>
            </div>

            <div class="w-full flex items-end justify-end">
                <button wire:click="exportExcel()"
                    class="inline-flex px-5 py-3 text-white bg-primary-100 hover:bg-primary-900 borde rounded-md">
                    <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1v6M5 19v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-1M10 3v4a1 1 0 0 1-1 1H5m2.665 9H6.647A1.647 1.647 0 0 1 5 15.353v-1.706A1.647 1.647 0 0 1 6.647 12h1.018M16 12l1.443 4.773L19 12m-6.057-.152-.943-.02a1.34 1.34 0 0 0-1.359 1.22 1.32 1.32 0 0 0 1.172 1.421l.536.059a1.273 1.273 0 0 1 1.226 1.718c-.2.571-.636.754-1.337.754h-1.13"/>
                      </svg>                      
                    Xuất Excel
                </button>
            </div>
        </div>
        
        @if (!$litsStatistics->isEmpty())
        <div>
            <div id="myChart"></div>
        </div>
        @endif

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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-black">Không có kết quả tìm kiếm phù hợp</p>
            @endif
        </div>

        {{ $litsStatistics->links('vendor.pagination.tailwind') }}

        <section class="grid md:grid-cols-2 gap-6 my-10">
            <div class="flex items-center p-8 bg-white shadow rounded-lg">
                <div
                    class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-blue-600 bg-blue-100 rounded-full mr-6">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M22 5.892a8.178 8.178 0 0 1-2.355.635 4.074 4.074 0 0 0 1.8-2.235 8.343 8.343 0 0 1-2.605.981A4.13 4.13 0 0 0 15.85 4a4.068 4.068 0 0 0-4.1 4.038c0 .31.035.618.105.919A11.705 11.705 0 0 1 3.4 4.734a4.006 4.006 0 0 0 1.268 5.392 4.165 4.165 0 0 1-1.859-.5v.05A4.057 4.057 0 0 0 6.1 13.635a4.192 4.192 0 0 1-1.856.07 4.108 4.108 0 0 0 3.831 2.807A8.36 8.36 0 0 1 2 18.184 11.732 11.732 0 0 0 8.291 20 11.502 11.502 0 0 0 19.964 8.5c0-.177 0-.349-.012-.523A8.143 8.143 0 0 0 22 5.892Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <span class="block text-2xl font-bold">{{ $petNumber }}</span>
                    <span class="block text-gray-500">Số lượng thú cưng được cứu trợ</span>
                    </span>
                </div>
            </div>
            <div class="flex items-center p-8 bg-white shadow rounded-lg">
                <div
                    class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-blue-600 bg-blue-100 rounded-full mr-6">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 12a28.076 28.076 0 0 1-1.091 9M7.231 4.37a8.994 8.994 0 0 1 12.88 3.73M2.958 15S3 14.577 3 12a8.949 8.949 0 0 1 1.735-5.307m12.84 3.088A5.98 5.98 0 0 1 18 12a30 30 0 0 1-.464 6.232M6 12a6 6 0 0 1 9.352-4.974M4 21a5.964 5.964 0 0 1 1.01-3.328 5.15 5.15 0 0 0 .786-1.926m8.66 2.486a13.96 13.96 0 0 1-.962 2.683M7.5 19.336C9 17.092 9 14.845 9 12a3 3 0 1 1 6 0c0 .749 0 1.521-.031 2.311M12 12c0 3 0 6-2 9" />
                    </svg>
                </div>
                <div>
                    <span class="block text-2xl font-bold">{{ $petAdoptionRequestNumber }}</span>
                    <span class="block text-gray-500">Số lượng thú cưng được nhận nuôi</span>
                    </span>
                </div>
            </div>
        </section>

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
                                    @if ($moneyAdoption->donor_id == 'US0000000000')
                                        Ẩn danh
                                    @else
                                        {{ $moneyAdoption->donor->first_name . ' ' . $moneyAdoption->donor->last_name }}
                                    @endif
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

@if (!$litsStatistics->isEmpty())
<script>
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(setupChart);

    function setupChart() {
        document.getElementById('chart-btn').addEventListener('click', drawChart);
    }
    
    function drawChart() {
        const data = google.visualization.arrayToDataTable([
            ['Quyên góp/Chi tiêu', 'Số tiền', { role: 'style' }],
            ['Quyên góp', {{ $statistics['total_amount_donation'] }}, 'color: #3366cc'],
            ['Chi tiêu', {{ $statistics['total_money_expenses'] }}, 'color: #dc3912']
        ]);
        
        const options = {
            title: 'Biểu đồ thu chi',
            chartArea: { width: '50%' },
            hAxis: {
                minValue: 0
            },
            vAxis: {
                title: 'VNĐ'
            }
        };

        const chart = new google.visualization.BarChart(document.getElementById('myChart'));
        chart.draw(data, options);
    }

    document.addEventListener('livewire:load', function () {
        window.livewire.on('reloadJavaScript', () => {
            drawChart();
        });
    });
</script>
@endif


