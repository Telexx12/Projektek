<?php

namespace App\Http\Livewire\Components;

use App\Models\Transaction;
use Livewire\Component;

class DashboardTransactions extends Component
{

    public $number_of_transactions;
    public $transactions;

    public function mount(){

        $this->number_of_transactions = 5;

        $this->getTransactions();
    }

    public function getTransactions(){
        $this->transactions = Transaction::where('user_id',auth()->user()->id)->orderBy('completed_date','desc')->take($this->number_of_transactions)->get();

    }

    public function incrementNumberOfTransactions(){
        $this->number_of_transactions += 5;

        $this->getTransactions();

    }

    public function render()
    {
        return view('livewire.components.dashboard-transactions');
    }
}
