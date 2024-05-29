<div class="flex justify-center items-center">
    <div class="p-10 my-6 w-96 md:w-4/5 bg-black text-white rounded-lg md:rounded-lg">
        <div class="flex h-full w-full">

            <form action="{{ route('vnpay-payment') }}" method="POST"
                class="h-full p-3 rounded-lg w-full bg-black text-white">
                @csrf
                <p class="font-semibold text-xl mt-2 text-primary-100 text-center">Bạn muốn gửi tặng món quà đến quỹ nào?
                </p>
                <div class="mt-4 w-full flex flex-col">
                    <div class="grid grid-cols-2 gap-2 w-full">
                        @foreach ($listFund as $index => $item)
                            <input class="appearance-none hidden" type="radio" name="fund"
                                id="select_option{{ $index }}" value={{ $item->fund_id }} required>
                            <label class="col-span-2 xl:col-span-1" for="select_option{{ $index }}">
                                <div
                                    class="click_option h-16 gap-3 cursor-pointer transition-all w-full px-2 border-2 flex justify-center items-center p-1">
                                    <img class="w-8" src="{{ $item->feature_image }}">
                                    <p class="text-sm font-semibold">{{ $item->title }}</p>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>
                <p class="text-sm mt-5">Sự đóng góp của bạn cho phép chúng tôi dành thêm một chút quan tâm đặc biệt cho
                    các động vật mà chúng tôi chăm sóc và sự giúp đỡ của bạn được đánh giá rất cao.</p>
                <p class="mt-3 font-semibold text-primary-100">Loại quyên góp</p>
                <div class="flex gap-2 mt-5">
                    <div class="w-full ">
                        <input class="appearance-none hidden" type="radio" name="donation_type" id="one_time"
                            value="one_time" required>
                        <label wire:click="updateDisplayedAmounts(1)" for="one_time">
                            <div
                                class="selecting h-10 font-semibold text-sm cursor-pointer transition-all justify-center items-center w-full border-2 flex ">
                                <p>Quà tặng một lần</p>
                            </div>
                        </label>
                    </div>
                    <div class="w-full ">
                        <input class="appearance-none hidden" type="radio" name="donation_type" id="monthly"
                            value="monthly" required>
                        <label wire:click="updateDisplayedAmounts(2)" for="monthly">
                            <div
                                class="selecting h-10 font-semibold text-sm cursor-pointer transition-all justify-center items-center w-full border-2 flex ">
                                <p>Quà tặng hàng tháng</p>
                            </div>
                        </label>
                    </div>
                </div>
                <p class="mt-3 font-semibold text-primary-100">Chọn gói quà tặng:</p>
                <div class="flex mt-5 gap-2">
                    @foreach ($displayedAmounts as $amount)
                        <div class="w-full ">
                            <input class="appearance-none hidden" type="radio" id="{{ $amount->amount }}"
                                name="amount" value={{ $amount->amount }} required>
                            <label wire:click="changeValue({{ $amount->amount }})" for="{{ $amount->amount }}"
                                class="h-10 font-semibold text-sm cursor-pointer transition-all justify-center items-center w-full border-2 flex ">{{ $amount->amount }}
                                VND</label>

                        </div>
                    @endforeach
                </div>
                <p class="mt-4 text-xl font-semibold text-primary-100">{{ $selectedAmount }} @if ($selectedAmount !== null)
                        VND
                    @endif
                </p>
                @if (Route::has('login'))
                    @auth
                    @else
                        <hr class="my-4">
                        <p class="text-sm mt-6 text-center">Bạn đang là người ẩn danh. Đăng nhập để lưu lại thông tin quyên
                            góp của bạn <a href="{{ route('login') }}"
                                class="text-primary-100 font-semibold hover:underline ml-1">Đăng&nbsp;nhập&nbsp;tại&nbsp;đây</a>
                        </p>
                    @endauth
                @endif
                <hr class="my-4">

                <div class="my-4 flex justify-between">
                    <button type="submit"
                        class="px-3 py-2 bg-primary-900 font-bold text-sm text-white rounded-lg cursor-pointer transition-all hover:bg-primary-100">Thanh
                        toán bằng VNPay</button>
                </div>
            </form>
            <div
                class="h-full hidden md:block relative md:rounded-lg px-36 overflow-hidden bg-[url('{{ asset('storage/images/app/home/donation.png') }}')] w-full">
                <img class="h-full w-full object-cover" src="{{ asset('storage/images/app/home/donation.png') }}">
            </div>
        </div>
    </div>

</div>
