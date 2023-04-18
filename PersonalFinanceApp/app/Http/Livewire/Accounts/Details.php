<?php

namespace App\Http\Livewire\Accounts;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Details extends Component
{
    public $account;

    public $transactions;

    public $amount;

    public $chartDatas = [];

    public function mount(){

        $this->transactions = Transaction::where('account_id', $this->account->id)->where('completed_date','>=',Carbon::now()->subMonth()->format('Y-m-d'))->get()->groupBy('completed_date')->toArray();

        $this->amount = Transaction::where('account_id', $this->account->id)->where('completed_date','<=',Carbon::now()->subMonth()->format('Y-m-d'))->sum('amount');

        $this->buildChartData($this->transactions,$this->amount);

    }

    protected function buildChartData($transactions,$amount){
        $current_amount = $amount;
        for($date = Carbon::now()->subMonth();$date <= Carbon::now();$date->addDay()){

            $day = $date->format('Y-m-d');

            if(array_key_exists($date->format('Y-m-d'),$this->transactions)){
                $change = 0;
               foreach ($this->transactions[$date->format('Y-m-d')] as $transaction){
                   $change += $transaction["amount"];
               }
              $current_amount += $change;
            }

            $this->chartDatas[$day] = $current_amount;
        }
    }

    public function render()
    {
        return view('livewire.accounts.details');
    }
}
