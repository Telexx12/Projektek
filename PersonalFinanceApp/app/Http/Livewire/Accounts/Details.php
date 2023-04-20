<?php

namespace App\Http\Livewire\Accounts;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Details extends Component
{
    public $account;


    public $number_of_transactions;
    public $transactions;


    public function mount(){
        $this->number_of_transactions = 5;

        $this->transactions = Transaction::take($this->number_of_transactions)->get();

    }

    public function render()
    {
        return view('livewire.accounts.details');
    }
}
