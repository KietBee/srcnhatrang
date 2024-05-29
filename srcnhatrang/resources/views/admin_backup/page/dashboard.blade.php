@extends('admin.layouts.admin')

@section('content')


<div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
  <div class="flex justify-between pb-4 mb-4 border-b border-gray-200 dark:border-gray-700">
    <div class="flex items-center">
      <div class="w-12 h-12 rounded-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center me-3">
        <svg class="w-6 h-6 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 19">
          <path d="M14.5 0A3.987 3.987 0 0 0 11 2.1a4.977 4.977 0 0 1 3.9 5.858A3.989 3.989 0 0 0 14.5 0ZM9 13h2a4 4 0 0 1 4 4v2H5v-2a4 4 0 0 1 4-4Z"/>
          <path d="M5 19h10v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2ZM5 7a5.008 5.008 0 0 1 4-4.9 3.988 3.988 0 1 0-3.9 5.859A4.974 4.974 0 0 1 5 7Zm5 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm5-1h-.424a5.016 5.016 0 0 1-1.942 2.232A6.007 6.007 0 0 1 17 17h2a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5ZM5.424 9H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h2a6.007 6.007 0 0 1 4.366-5.768A5.016 5.016 0 0 1 5.424 9Z"/>
        </svg>
      </div>
      <div>
        <h5 class="leading-none text-2xl font-bold text-gray-900 dark:text-white pb-1">3.4k</h5>
        <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Leads generated per week</p>
      </div>
    </div>
    <div>
      <span class="bg-green-100 text-green-800 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md dark:bg-green-900 dark:text-green-300">
        <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13V1m0 0L1 5m4-4 4 4"/>
        </svg>
        42.5%
      </span>
    </div>
  </div>

  <div class="grid grid-cols-2">
    <dl class="flex items-center">
        <dt class="text-gray-500 dark:text-gray-400 text-sm font-normal me-1">Money spent:</dt>
        <dd class="text-gray-900 text-sm dark:text-white font-semibold">$3,232</dd>
    </dl>
    <dl class="flex items-center justify-end">
        <dt class="text-gray-500 dark:text-gray-400 text-sm font-normal me-1">Conversion rate:</dt>
        <dd class="text-gray-900 text-sm dark:text-white font-semibold">1.2%</dd>
    </dl>
  </div>

  <div id="column-chart"></div>
    <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
      <div class="flex justify-between items-center pt-5">
        <!-- Button -->
        <button
          id="dropdownDefaultButton"
          data-dropdown-toggle="lastDaysdropdown"
          data-dropdown-placement="bottom"
          class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 text-center inline-flex items-center dark:hover:text-white"
          type="button">
          Last 7 days
          <svg class="w-2.5 m-2.5 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
          </svg>
        </button>
        <!-- Dropdown menu -->
        <div id="lastDaysdropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
              <li>
                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Yesterday</a>
              </li>
              <li>
                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Today</a>
              </li>
              <li>
                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 7 days</a>
              </li>
              <li>
                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 30 days</a>
              </li>
              <li>
                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 90 days</a>
              </li>
            </ul>
        </div>
        <a
          href="#"
          class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">
          Leads Report
          <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
          </svg>
        </a>
      </div>
    </div>
</div>

<div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
  <div class="flex justify-between border-gray-200 border-b dark:border-gray-700 pb-3">
    <dl>
      <dt class="text-base font-normal text-gray-500 dark:text-gray-400 pb-1">Profit</dt>
      <dd class="leading-none text-3xl font-bold text-gray-900 dark:text-white">$5,405</dd>
    </dl>
    <div>
      <span class="bg-green-100 text-green-800 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md dark:bg-green-900 dark:text-green-300">
        <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13V1m0 0L1 5m4-4 4 4"/>
        </svg>
        Profit rate 23.5%
      </span>
    </div>
  </div>

  <div class="grid grid-cols-2 py-3">
    <dl>
      <dt class="text-base font-normal text-gray-500 dark:text-gray-400 pb-1">Income</dt>
      <dd class="leading-none text-xl font-bold text-green-500 dark:text-green-400">$23,635</dd>
    </dl>
    <dl>
      <dt class="text-base font-normal text-gray-500 dark:text-gray-400 pb-1">Expense</dt>
      <dd class="leading-none text-xl font-bold text-red-600 dark:text-red-500">-$18,230</dd>
    </dl>
  </div>

  <div id="bar-chart"></div>
    <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
      <div class="flex justify-between items-center pt-5">
        <!-- Button -->
        <button
          id="dropdownDefaultButton"
          data-dropdown-toggle="lastDaysdropdown"
          data-dropdown-placement="bottom"
          class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 text-center inline-flex items-center dark:hover:text-white"
          type="button">
          Last 6 months
          <svg class="w-2.5 m-2.5 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
          </svg>
        </button>
        <!-- Dropdown menu -->
        <div id="lastDaysdropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
              <li>
                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Yesterday</a>
              </li>
              <li>
                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Today</a>
              </li>
              <li>
                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 7 days</a>
              </li>
              <li>
                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 30 days</a>
              </li>
              <li>
                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 90 days</a>
              </li>
              <li>
                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 6 months</a>
              </li>
              <li>
                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last year</a>
              </li>
            </ul>
        </div>
        <a
          href="#"
          class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">
          Revenue Report
          <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
          </svg>
        </a>
      </div>
    </div>
</div>

{{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> --}}
<script>
  
const options = {
  series: [
    {
      name: "Income",
      color: "#31C48D",
      data: ["1420", "1620", "1820", "1420", "1650", "2120"],
    },
    {
      name: "Expense",
      data: ["788", "810", "866", "788", "1100", "1200"],
      color: "#F05252",
    }
  ],
  chart: {
    sparkline: {
      enabled: false,
    },
    type: "bar",
    width: "100%",
    height: 400,
    toolbar: {
      show: false,
    }
  },
  fill: {
    opacity: 1,
  },
  plotOptions: {
    bar: {
      horizontal: true,
      columnWidth: "100%",
      borderRadiusApplication: "end",
      borderRadius: 6,
      dataLabels: {
        position: "top",
      },
    },
  },
  legend: {
    show: true,
    position: "bottom",
  },
  dataLabels: {
    enabled: false,
  },
  tooltip: {
    shared: true,
    intersect: false,
    formatter: function (value) {
      return "$" + value
    }
  },
  xaxis: {
    labels: {
      show: true,
      style: {
        fontFamily: "Inter, sans-serif",
        cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
      },
      formatter: function(value) {
        return "$" + value
      }
    },
    categories: ["Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    axisTicks: {
      show: false,
    },
    axisBorder: {
      show: false,
    },
  },
  yaxis: {
    labels: {
      show: true,
      style: {
        fontFamily: "Inter, sans-serif",
        cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
      }
    }
  },
  grid: {
    show: true,
    strokeDashArray: 4,
    padding: {
      left: 2,
      right: 2,
      top: -20
    },
  },
  fill: {
    opacity: 1,
  }
}

if(document.getElementById("bar-chart") && typeof ApexCharts !== 'undefined') {
  const chart = new ApexCharts(document.getElementById("bar-chart"), options);
  chart.render();
}


//   const options = {
//   colors: ["#1A56DB", "#FDBA8C"],
//   series: [
//     {
//       name: "Organic",
//       color: "#1A56DB",
//       data: [
//         { x: "Mon", y: 231 },
//         { x: "Tue", y: 122 },
//         { x: "Wed", y: 63 },
//         { x: "Thu", y: 421 },
//         { x: "Fri", y: 122 },
//         { x: "Sat", y: 323 },
//         { x: "Sun", y: 111 },
//       ],
//     },
//     {
//       name: "Social media",
//       color: "#FDBA8C",
//       data: [
//         { x: "Mon", y: 232 },
//         { x: "Tue", y: 113 },
//         { x: "Wed", y: 341 },
//         { x: "Thu", y: 224 },
//         { x: "Fri", y: 522 },
//         { x: "Sat", y: 411 },
//         { x: "Sun", y: 243 },
//       ],
//     },
//   ],
//   chart: {
//     type: "bar",
//     height: "320px",
//     fontFamily: "Inter, sans-serif",
//     toolbar: {
//       show: false,
//     },
//   },
//   plotOptions: {
//     bar: {
//       horizontal: false,
//       columnWidth: "70%",
//       borderRadiusApplication: "end",
//       borderRadius: 8,
//     },
//   },
//   tooltip: {
//     shared: true,
//     intersect: false,
//     style: {
//       fontFamily: "Inter, sans-serif",
//     },
//   },
//   states: {
//     hover: {
//       filter: {
//         type: "darken",
//         value: 1,
//       },
//     },
//   },
//   stroke: {
//     show: true,
//     width: 0,
//     colors: ["transparent"],
//   },
//   grid: {
//     show: false,
//     strokeDashArray: 4,
//     padding: {
//       left: 2,
//       right: 2,
//       top: -14
//     },
//   },
//   dataLabels: {
//     enabled: false,
//   },
//   legend: {
//     show: false,
//   },
//   xaxis: {
//     floating: false,
//     labels: {
//       show: true,
//       style: {
//         fontFamily: "Inter, sans-serif",
//         cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
//       }
//     },
//     axisBorder: {
//       show: false,
//     },
//     axisTicks: {
//       show: false,
//     },
//   },
//   yaxis: {
//     show: false,
//   },
//   fill: {
//     opacity: 1,
//   },
// }

// if(document.getElementById("column-chart") && typeof ApexCharts !== 'undefined') {
//   const chart = new ApexCharts(document.getElementById("column-chart"), options);
//   chart.render();
// }

</script>
{{-- <div
  class="col-span-12 rounded-sm border border-stroke bg-white px-5 pb-5 pt-7.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:col-span-8"
>
  <div class="flex flex-wrap items-start justify-between gap-3 sm:flex-nowrap">
    <div class="flex w-full flex-wrap gap-3 sm:gap-5">
      <div class="flex min-w-47.5">
        <span
          class="mr-2 mt-1 flex h-4 w-full max-w-4 items-center justify-center rounded-full border border-primary"
        >
          <span
            class="block h-2.5 w-full max-w-2.5 rounded-full bg-primary"
          ></span>
        </span>
        <div class="w-full">
          <p class="font-semibold text-primary">Total Revenue</p>
          <p class="text-sm font-medium">12.04.2022 - 12.05.2022</p>
        </div>
      </div>
      <div class="flex min-w-47.5">
        <span
          class="mr-2 mt-1 flex h-4 w-full max-w-4 items-center justify-center rounded-full border border-secondary"
        >
          <span
            class="block h-2.5 w-full max-w-2.5 rounded-full bg-secondary"
          ></span>
        </span>
        <div class="w-full">
          <p class="font-semibold text-secondary">Total Sales</p>
          <p class="text-sm font-medium">12.04.2022 - 12.05.2022</p>
        </div>
      </div>
    </div>
    <div class="flex w-full max-w-45 justify-end">
      <div
        class="inline-flex items-center rounded-md bg-whiter p-1.5 dark:bg-meta-4"
      >
        <button
          class="rounded bg-white px-3 py-1 text-xs font-medium text-black shadow-card hover:bg-white hover:shadow-card dark:bg-boxdark dark:text-white dark:hover:bg-boxdark"
        >
          Day
        </button>
        <button
          class="rounded px-3 py-1 text-xs font-medium text-black hover:bg-white hover:shadow-card dark:text-white dark:hover:bg-boxdark"
        >
          Week
        </button>
        <button
          class="rounded px-3 py-1 text-xs font-medium text-black hover:bg-white hover:shadow-card dark:text-white dark:hover:bg-boxdark"
        >
          Month
        </button>
      </div>
    </div>
  </div>
  <div>
    <div id="chartOne" class="-ml-5"></div>
  </div>
</div> --}}

  {{-- <style>
    a.active {
        border: solid #93c5fd 1px;
        background-color: #54a5ff;
        color: white;
    }
    a.active:hover {
        background-color: #2a7bd4;
        color: white;
    }
    .field-value tr:nth-child(even){
        background-color: #f2f2f2;
    }
    .field-value tr:nth-child(even):hover {
        background-color: rgb(229 231 235);
    }
</style>
    <div class="container lg:max-w-[1600px] mx-auto my-10 px-10">
        <div x-data="{ showModal1: false, showModal2: false, showModal3: false, id: '', name: '', status: ''}">
            <div class="flex">
                <button @click="showModal1 = true" class="w-[10%] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                    Add new
                </button>
                <div class="w-[80%] text-center text-5xl font-bold">Brandwatch - FAB Dashboards</div>
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
                                Brand
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Project ID
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Query ID
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Date create
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Rows
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Delete
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Detail
                            </th>
                        </tr>
                    </thead>
                    <tbody class="field-value">
                      echo '<tr class="bg-white border-b border-gray-200 hover:bg-gray-200">';
                        echo '<td class="px-6 py-4">'.$value->ID.'</td>';
                        echo '<td class="px-6 py-4">'.$value->brand.'</td>';
                        echo '<td class="px-6 py-4">'.$value->project_ID.'</td>';
                        echo '<td class="px-6 py-4">'.$value->query_ID.'</td>';
                        echo '<td class="px-6 py-4">'.$value->created_at.'</td>';
                        echo '<td class="px-6 py-4">'.$rows[0]['COUNT(*)'].'</td>';
                        echo '<td class="px-6 py-4 flex">
                        <button x-on:click="showModal3 = true; status = '.$value->status.'; id = '.$value->ID.';"  class="mx-auto btn-status text-white font-medium rounded-lg text-sm px-5 py-2.5 '.$bg_color.'">
                                '.$status_value.'
                                </button>
                            </td>';
                        echo '<td class="px-6 py-4 hover:cursor-pointer text-red-800 hover:text-red-600">
                        <svg  x-on:click="showModal2 = true; id = '.$value->ID.'; name = \''.$value->brand.'\';" class="mx-auto feather feather-trash-2" fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                        </td>
                        <td class="px-6 py-4 hover:cursor-pointer text-blue-800 hover:text-blue-600">
                        <svg x-bind:data-id="'.$value->ID.'" class="value-id mx-auto feather feather-info" fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="16" y2="12"/><line x1="12" x2="12.01" y1="8" y2="8"/></svg></td></tr>';
                        echo '<tr class="bg-white border-b border-gray-200 hover:bg-gray-200">';
                          echo '<td class="px-6 py-4">'.$value->ID.'</td>';
                          echo '<td class="px-6 py-4">'.$value->brand.'</td>';
                          echo '<td class="px-6 py-4">'.$value->project_ID.'</td>';
                          echo '<td class="px-6 py-4">'.$value->query_ID.'</td>';
                          echo '<td class="px-6 py-4">'.$value->created_at.'</td>';
                          echo '<td class="px-6 py-4">'.$rows[0]['COUNT(*)'].'</td>';
                          echo '<td class="px-6 py-4 flex">
                          <button x-on:click="showModal3 = true; status = '.$value->status.'; id = '.$value->ID.';"  class="mx-auto btn-status text-white font-medium rounded-lg text-sm px-5 py-2.5 '.$bg_color.'">
                                  '.$status_value.'
                                  </button>
                              </td>';
                          echo '<td class="px-6 py-4 hover:cursor-pointer text-red-800 hover:text-red-600">
                          <svg  x-on:click="showModal2 = true; id = '.$value->ID.'; name = \''.$value->brand.'\';" class="mx-auto feather feather-trash-2" fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                          </td>
                          <td class="px-6 py-4 hover:cursor-pointer text-blue-800 hover:text-blue-600">
                          <svg x-bind:data-id="'.$value->ID.'" class="value-id mx-auto feather feather-info" fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="16" y2="12"/><line x1="12" x2="12.01" y1="8" y2="8"/></svg></td></tr>';
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
    </div> --}}
@endsection
