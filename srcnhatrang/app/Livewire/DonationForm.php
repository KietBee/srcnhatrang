<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PredefinedOnlyAmount;
use App\Models\PredefinedMonthlyAmount;

class DonationForm extends Component
{
    public $donationType = 'one_time';
    public $amount;
    public $predefinedOnlyAmounts;
    public $predefinedMonthlyAmounts;
    public $displayedAmounts;
    public $selectedAmount;


    public function mount()
    {
        $this->predefinedOnlyAmounts = PredefinedOnlyAmount::all();
        $this->predefinedMonthlyAmounts = PredefinedMonthlyAmount::all();
    }

    public function updateDisplayedAmounts($status)
    {
        if ($status == 1) {
            $this->displayedAmounts = PredefinedOnlyAmount::all();
        } else {
            $this->displayedAmounts = PredefinedMonthlyAmount::all();
        }
        $this->reset('selectedAmount');
    }
    public function changeValue($value) {
        $this->selectedAmount = $value;
    }

    public function render()
    {
        if($this->displayedAmounts == null) {
            $this->displayedAmounts = PredefinedOnlyAmount::all();
        }
        return view('livewire.donation-form');
    }
}
