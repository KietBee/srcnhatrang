<?php

namespace App\Livewire;

use App\Models\Expense;
use App\Models\MoneyDonation;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Statistic;
use Carbon\Carbon;

class Statistics extends Component
{
    use WithPagination {
        WithPagination::resetPage as resetDefaultPage;
    }

    public $year;
    public $month;
    public $years = [];
    public $perPage = 10;

    protected $queryString = [
        'year' => ['except' => ''],
        'month' => ['except' => ''],
    ];

    public function mount()
    {
        $this->year = $this->year ?? Carbon::now()->year;
        $this->month = $this->month ?? Carbon::now()->month; // Thêm mặc định cho tháng hiện tại nếu không có
        $this->years = $this->getYears();
    }

    private function getYears()
    {
        $oldestYear = Statistic::orderBy('year', 'asc')->value('year');
        $currentYear = Carbon::now()->year;

        if ($oldestYear !== null) {
            return range($currentYear, $oldestYear);
        } else {
            return [$currentYear];
        }
    }

    public function render()
    {
        sleep(1);

        $litsStatistics = Statistic::query()
            ->when($this->year, function ($query) {
                $query->where('year', $this->year);
            })
            ->when($this->month, function ($query) {
                $query->where('month', $this->month);
            })
            ->paginate($this->perPage, ['*'], 'statisticsPage');

        $litsMoneyAdoptions = MoneyDonation::query()
            ->when($this->year, function ($query) {
                $query->whereYear('created_at', $this->year);
            })
            ->when($this->month, function ($query) {
                $query->whereMonth('created_at', $this->month);
            })
            ->paginate($this->perPage, ['*'], 'moneyDonationsPage');

        $litsExpenses = Expense::query()
            ->when($this->year, function ($query) {
                $query->whereYear('created_at', $this->year);
            })
            ->when($this->month, function ($query) {
                $query->whereMonth('created_at', $this->month);
            })
            ->paginate($this->perPage, ['*'], 'expensesPage');

        return view('livewire.statistics', [
            'litsStatistics' => $litsStatistics,
            'litsMoneyAdoptions' => $litsMoneyAdoptions,
            'litsExpenses' => $litsExpenses,
            'years' => $this->years,
        ]);
    }
}
