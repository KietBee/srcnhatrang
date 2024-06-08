@extends('layouts.admin')
@section('content')
    <main class="p-6 sm:p-10 space-y-6">
        <div class="flex flex-col space-y-6 md:space-y-0 md:flex-row justify-between">
            <div class="mr-6">
                <h1 class="text-4xl font-semibold mb-2">
                    {{ $title . ' ' . Auth::user()->first_name . ' ' . Auth::user()->last_name . '!' }}</h1>
                <h2 class="text-gray-600 ml-0.5">{{ 'Bây giờ là ' . now()->format('H:i:s d/m/Y') }}</h2>
            </div>
            <div class="flex flex-wrap items-start justify-end -mb-3 gap-3">
                <button id="refresh" class="inline-flex px-5 py-3 text-white hover:bg-primary-100  bg-primary-950 rounded-md mb-3">
                    <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.651 7.65a7.131 7.131 0 0 0-12.68 3.15M18.001 4v4h-4m-7.652 8.35a7.13 7.13 0 0 0 12.68-3.15M6 20v-4h4" />
                    </svg>

                    Làm mới dữ liệu
                </button>
            </div>
        </div>
        <section class="grid md:grid-cols-2 xl:grid-cols-4 gap-6">
            <a href="#" class="flex items-center p-8 bg-white shadow rounded-lg bump-up">
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
                    <span class="block text-2xl font-bold counter" data-target="{{ $petNumber }}"></span>
                    <span class="block text-gray-500">Số lượng thú cưng ở trung tâm</span>
                    </span>
                </div>
            </a>
            <a href="#" class="flex items-center p-8 bg-white shadow rounded-lg bump-up">
                <div
                    class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-blue-600 bg-blue-100 rounded-full mr-6">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 12a28.076 28.076 0 0 1-1.091 9M7.231 4.37a8.994 8.994 0 0 1 12.88 3.73M2.958 15S3 14.577 3 12a8.949 8.949 0 0 1 1.735-5.307m12.84 3.088A5.98 5.98 0 0 1 18 12a30 30 0 0 1-.464 6.232M6 12a6 6 0 0 1 9.352-4.974M4 21a5.964 5.964 0 0 1 1.01-3.328 5.15 5.15 0 0 0 .786-1.926m8.66 2.486a13.96 13.96 0 0 1-.962 2.683M7.5 19.336C9 17.092 9 14.845 9 12a3 3 0 1 1 6 0c0 .749 0 1.521-.031 2.311M12 12c0 3 0 6-2 9" />
                    </svg>
                </div>
                <div>
                    <span class="block text-2xl font-bold counter" data-target="{{ $petAdoptionRequestNumber }}"></span>
                    <span class="block text-gray-500">Yêu cầu nhận nuôi chưa kiểm duyệt</span>
                    </span>
                </div>
            </a>

            <a href="#" class="flex items-center p-8 bg-white shadow rounded-lg bump-up">
                <div
                    class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-blue-600 bg-blue-100 rounded-full mr-6">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M2 6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6Zm4.996 2a1 1 0 0 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM11 8a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2h-6Zm-4.004 3a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM11 11a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2h-6Zm-4.004 3a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM11 14a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2h-6Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <span class="block text-2xl font-bold counter" data-target="{{ $storyNumber }}"></span>
                    <span class="block text-gray-500">Bài viết chưa kiểm duyệt</span>
                    </span>
                </div>
            </a>
            <a class="flex items-center p-8 bg-white shadow rounded-lg bump-up">
                <div
                    class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-blue-600 bg-blue-100 rounded-full mr-6">
                    <svg class="w-[30px] h-[30px] text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M14.502 7.046h-2.5v-.928a2.122 2.122 0 0 0-1.199-1.954 1.827 1.827 0 0 0-1.984.311L3.71 8.965a2.2 2.2 0 0 0 0 3.24L8.82 16.7a1.829 1.829 0 0 0 1.985.31 2.121 2.121 0 0 0 1.199-1.959v-.928h1a2.025 2.025 0 0 1 1.999 2.047V19a1 1 0 0 0 1.275.961 6.59 6.59 0 0 0 4.662-7.22 6.593 6.593 0 0 0-6.437-5.695Z" />
                    </svg>
                </div>
                <div>
                    <span class="block text-2xl font-bold counter" data-target="{{ $feedBackNumber }}"></span>
                    <span class="block text-gray-500">Phản hồi chưa trả lời</span>
                    </span>
                </div>
            </a>
        </section>
        <section class="grid md:grid-cols-2 xl:grid-cols-4 xl:grid-rows-3 xl:grid-flow-col gap-6">
            <div class="flex flex-col md:col-span-2 md:row-span-2 bg-white shadow rounded-lg">
                <div class="px-6 py-5 font-semibold border-b border-gray-100">Biểu đồ số lượng quyên góp trong ngày</div>
                <div class="p-4 flex-grow">
                    @if ($donationData && count($donationData) > 0)
                        <div class="text-gray-400 text-3xl bg-gray-100 border-2 border-gray-200 border-dashed rounded-md">
                            <div id="myChart"></div>
                        </div>
                    @else
                        <div
                            class="flex items-center justify-center h-full px-4 py-16 text-gray-400 text-3xl font-semibold bg-gray-100 border-2 border-gray-200 border-dashed rounded-md">
                            Chưa có dữ liệu thống kê
                        </div>
                    @endif
                </div>
            </div>
            <div class="flex items-center p-8 bg-white shadow rounded-lg">
                <div
                    class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-yellow-600 bg-yellow-100 rounded-full mr-6">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                            clip-rule="evenodd" />
                    </svg>

                </div>
                <div>
                    <span class="block text-2xl font-bold">{{ $userNumber }}</span>
                    <span class="block text-gray-500">Số lượng tài khoản</span>
                </div>
            </div>
            <div class="flex items-center p-8 bg-white shadow rounded-lg">
                <div
                    class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-teal-600 bg-teal-100 rounded-full mr-6">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 12h4m-2 2v-4M4 18v-1a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v1a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1Zm8-10a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>

                </div>
                <div>
                    <span class="block text-2xl font-bold">{{ $newUserNumber }}</span>
                    <span class="block text-gray-500">Số lượng tài khoản mới trong ngày</span>
                </div>
            </div>

            <div class="flex flex-col md:col-span-2 md:row-span-3 bg-white shadow rounded-lg">
                <div class="px-6 py-5 font-semibold border-b border-gray-100">Biểu đồ quyên góp và chi tiêu của năm</div>
                <div class="p-4 flex-grow">
                    <div class="h-full bg-gray-100 border-2 border-gray-200 border-dashed rounded-md p-2">
                        <div id="columnchart_material" class="h-full"></div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script>
        google.charts.load('current', {
            packages: ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            // Set Data
            const data = google.visualization.arrayToDataTable([
                ['Price', 'Size'],
                @foreach ($donationData as $index => $item)
                    [{{ $index }}, {{ $item }}],
                @endforeach
            ]);

            // Set Options
            const options = {
                legend: 'none',
                pointSize: 2,
                animation: {
                    startup: true,
                    duration: 1000,
                    easing: 'out'
                },
                curveType: 'function',
                hAxis: {title: 'Giờ'},
                vAxis: {title: 'Số lượng quyên góp'},
            };

            // Draw
            const chart = new google.visualization.LineChart(document.getElementById('myChart'));
            chart.draw(data, options);
        }


        google.charts.load('current', {
            'packages': ['bar']
        });
        google.charts.setOnLoadCallback(drawChartMaterial);
        var monthlyTotals = @json($monthlyTotals);
        function drawChartMaterial() {
            var data = google.visualization.arrayToDataTable([
                ['Năm {{ now()->year }}', 'Tổng quyên góp', 'Tổng chi tiêu'],
                @foreach($monthlyTotals as $month => $totals)
                ['{{ $month }}', {{ $totals['total_money_expenses'] }}, {{ $totals['total_amount_donation'] }}],
            @endforeach
            ]);
            var options = {
                animation: {
                    startup: true,
                    duration: 1000,
                    easing: 'out'
                },
            };

            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
        const counters = document.querySelectorAll(".counter");

        counters.forEach((counter) => {
            counter.innerText = "0";
            const updateCounter = () => {
                const target = +counter.getAttribute("data-target");
                const count = +counter.innerText;
                const increment = target / 200;
                if (count < target) {
                    counter.innerText = `${Math.ceil(count + increment)}`;
                    setTimeout(updateCounter, 1);
                } else counter.innerText = target;
            };
            updateCounter();
        });

        $(document).ready(function() {
            $('#refresh').click(function() {
                location.reload();
            });
        });
    </script>
@endsection
