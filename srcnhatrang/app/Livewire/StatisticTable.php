<?php

namespace App\Livewire;

use App\Helpers\ExcelHelpers;
use App\Models\Expense;
use App\Models\Fund;
use App\Models\MoneyDonation;
use App\Models\Pet;
use App\Models\PetAdoption;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Statistic;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StatisticTable extends Component
{
    use WithPagination {
        WithPagination::resetPage as resetDefaultPage;
    }

    public $year;
    public $month;
    public $fund;
    public $funds;
    public $years = [];
    public $perPage = 10;

    protected $queryString = [
        'year' => ['except' => ''],
        'month' => ['except' => ''],
        'fund' => ['except' => ''],
    ];

    public function mount()
    {
        $this->year = $this->year ?? Carbon::now()->year;
        $this->month = $this->month ?? Carbon::now()->month;
        $this->fund = $this->fund ?? Fund::first()->fund_id;

        $this->years = $this->getYears();
        $this->funds = Fund::all();
    }

    private function getYears()
    {
        $oldestDonationDate = DB::table('money_donations')->min('created_at');
        $oldestExpenseDate = DB::table('expenses')->min('created_at');

        $oldestYear = min(
            date('Y', strtotime($oldestDonationDate)),
            date('Y', strtotime($oldestExpenseDate))
        );

        $currentYear = Carbon::now()->year;

        if ($oldestYear !== null) {
            return range($currentYear, $oldestYear);
        } else {
            return [$currentYear];
        }
    }

    public function exportExcel()
    {
        $data = Statistic::query()
            ->when($this->year, function ($query, $year) {
                $query->where('year', $year);
            })
            ->when($this->month, function ($query, $month) {
                $query->where('month', $month);
            })
            ->when($this->fund, function ($query, $fund) {
                $query->where('fund_id', $fund);
            })
            ->whereRaw('(total_money_expenses != 0 AND total_amount_donation != 0)')
            ->get();

        $petNumber = Pet::query()
            ->when($this->year, function ($query, $year) {
                $query->whereYear('created_at', $year);
            })
            ->when($this->month, function ($query, $month) {
                $query->whereMonth('created_at', $month);
            })
            ->count();

        $petAdoptionRequestNumber = PetAdoption::query()
            ->where('adopted', true)
            ->when($this->year, function ($query, $year) {
                $query->whereYear('created_at', $year);
            })
            ->when($this->month, function ($query, $month) {
                $query->whereMonth('created_at', $month);
            })
            ->count();

        $formattedData = $data->map(function ($statistic) use ($petNumber, $petAdoptionRequestNumber) {
            return [
                'ID' => $statistic->statistic_id,
                'Tháng' => $statistic->month,
                'Năm' => $statistic->year,
                'Tên quỹ chi tiêu' => $statistic->fund->title ?? 'N/A',
                'Tổng tiền quyên góp' => $statistic->total_amount_donation,
                'Tổng tiền chi tiêu' => $statistic->total_money_expenses,
                'Tổng thú cưng được cứu trợ' => $petNumber,
                'Tổng thú cưng được nhận nuôi' => $petAdoptionRequestNumber
            ];
        })->toArray();

        $headings = [
            'ID',
            'Tháng',
            'Năm',
            'Tên quỹ chi tiêu',
            'Tổng tiền quyên góp',
            'Tổng tiền chi tiêu',
            'Tổng thú cưng được cứu trợ',
            'Tổng thú cưng được nhận nuôi'
        ];

        $fileName = 'baocaothongke_' . now()->format('Ymd_His') . '.xlsx';

        return ExcelHelpers::exportToExcel($headings, $formattedData, $fileName);
    }

    public function render()
    {
        sleep(1);

        $existingStatistic = Statistic::where('year', $this->year)
            ->where('month', $this->month)
            ->when($this->fund, function ($query, $fund) {
                $query->where('fund_id', $fund);
            })
            ->first();

        if (!$existingStatistic) {
            $totalAmountDonation = DB::table('money_donations')
                ->whereYear('created_at', $this->year)
                ->whereMonth('created_at', $this->month)
                ->where('fund_id', $this->fund)
                ->sum('amount');

            $totalMoneyExpenses = DB::table('expenses')
                ->whereYear('created_at', $this->year)
                ->whereMonth('created_at', $this->month)
                ->where('fund_id', $this->fund)
                ->sum('amount');

            if ($totalAmountDonation == 0 && $totalMoneyExpenses == 0) {
            } else {
                $newStatistic = new Statistic();
                $newStatistic->statistic_id = 'ST' . Carbon::now()->format('Hisdm');
                $newStatistic->year = $this->year;
                $newStatistic->month = $this->month;
                $newStatistic->fund_id = $this->fund;
                $newStatistic->statist = Auth::user()->id;
                $newStatistic->total_amount_donation = $totalAmountDonation;
                $newStatistic->total_money_expenses = $totalMoneyExpenses;
                $newStatistic->save();
            }
        }

        $litsStatistics = Statistic::query()
            ->when($this->year, function ($query, $year) {
                $query->where('year', $year);
            })
            ->when($this->month, function ($query, $month) {
                $query->where('month', $month);
            })
            ->when($this->fund, function ($query, $fund) {
                $query->where('fund_id', $fund);
            })
            ->whereRaw('(total_money_expenses != 0 AND total_amount_donation != 0)')
            ->paginate($this->perPage, ['*'], 'statisticsPage');

        $petNumber = Pet::query()
            ->when($this->year, function ($query, $year) {
                $query->whereYear('created_at', $year);
            })
            ->when($this->month, function ($query, $month) {
                $query->whereMonth('created_at', $month);
            })
            ->count();

        $petAdoptionRequestNumber = PetAdoption::query()
            ->where('adopted', true)
            ->when($this->year, function ($query, $year) {
                $query->whereYear('created_at', $year);
            })
            ->when($this->month, function ($query, $month) {
                $query->whereMonth('created_at', $month);
            })
            ->count();

        $litsMoneyAdoptions = MoneyDonation::query()
            ->when($this->year, function ($query, $year) {
                $query->whereYear('created_at', $year);
            })
            ->when($this->month, function ($query, $month) {
                $query->whereMonth('created_at', $month);
            })
            ->when($this->fund, function ($query, $fund) {
                $query->where('fund_id', $fund);
            })
            ->paginate($this->perPage, ['*'], 'moneyDonationsPage');

        $litsExpenses = Expense::query()
            ->when($this->year, function ($query, $year) {
                $query->whereYear('created_at', $year);
            })
            ->when($this->month, function ($query, $month) {
                $query->whereMonth('created_at', $month);
            })
            ->when($this->fund, function ($query, $fund) {
                $query->where('fund_id', $fund);
            })
            ->paginate($this->perPage, ['*'], 'expensesPage');

        return view('livewire.statistic-table', [
            'litsStatistics' => $litsStatistics,
            'petNumber' => $petNumber,
            'petAdoptionRequestNumber' => $petAdoptionRequestNumber,
            'litsMoneyAdoptions' => $litsMoneyAdoptions,
            'litsExpenses' => $litsExpenses,
            'years' => $this->years,
            'funds' => $this->funds,
        ]);
    }
}
