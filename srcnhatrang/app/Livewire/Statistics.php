<?php
namespace App\Livewire;

use App\Models\Expense;
use App\Models\Fund;
use App\Models\MoneyDonation;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Statistic;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Statistics extends Component
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
        $this->years = $this->getYears();
        $this->funds = Fund::all();
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
            ->when($this->fund, function ($query) {
                $query->where('fund_id', $this->fund);
            })
            ->paginate($this->perPage, ['*'], 'statisticsPage');

        $litsMoneyAdoptions = MoneyDonation::query()
            ->when($this->year, function ($query) {
                $query->whereYear('created_at', $this->year);
            })
            ->when($this->month, function ($query) {
                $query->whereMonth('created_at', $this->month);
            })
            ->when($this->fund, function ($query) {
                $query->where('fund_id', $this->fund);
            })
            ->paginate($this->perPage, ['*'], 'moneyDonationsPage');

        $litsExpenses = Expense::query()
            ->when($this->year, function ($query) {
                $query->whereYear('created_at', $this->year);
            })
            ->when($this->month, function ($query) {
                $query->whereMonth('created_at', $this->month);
            })
            ->when($this->fund, function ($query) {
                $query->where('fund_id', $this->fund);
            })
            ->paginate($this->perPage, ['*'], 'expensesPage');

        return view('livewire.statistics', [
            'litsStatistics' => $litsStatistics,
            'litsMoneyAdoptions' => $litsMoneyAdoptions,
            'litsExpenses' => $litsExpenses,
            'years' => $this->years,
            'funds' => $this->funds,
        ]);
    }
}
