<?php

use Illuminate\Console\Command;
use App\Models\MoneyDonation;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyMail;

class CheckMoneyDonations extends Command
{
    protected $signature = 'donation:check';
    protected $description = 'Check money donations and send notification emails';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $moneyDonations = MoneyDonation::where('frequency', true)->get();

        foreach ($moneyDonations as $donation) {
            if (now()->day == $donation->created_at->day) {
                $user = $donation->donor;
                $title = 'SRC Nha Trang - Nhắc lịch quyên góp';
                $content = 'Cảm ơn bạn đã gửi tặng món quà cho chúng tôi vào tháng trước! Hôm nay đã đến lịch quyên góp mà bạn đã đăng ký.';
                $view = 'email.feedback';
                Mail::to($user->email)->send(new NotifyMail($title, $content, $view));

            }
        }

        $this->info('Money donations checked successfully.');
    }
}
