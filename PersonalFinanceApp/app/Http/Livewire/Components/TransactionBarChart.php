<?php

namespace App\Http\Livewire\Components;

use App\Models\Transaction;
use Carbon\Carbon;
use Livewire\Component;

class TransactionBarChart extends Component
{

    public $account;

    public $data = [];

    protected $listeners =  [
        'transactionAdded'
    ];


    public function transactionAdded(){
        $this->data = Transaction::query()
            ->where('account_id', $this->account->id)
            ->where('completed_date', '>=', Carbon::now()->subMonths(2))
            ->selectRaw('month(completed_date) as month')
            ->selectRaw('count(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('count','month')
            ->toArray();

        $this->emit('updateBarChart');
    }


    public function mount()
    {
        $this->data = Transaction::query()
            ->where('account_id', $this->account->id)
            ->where('completed_date', '>=', Carbon::now()->subMonths(2))
            ->selectRaw('month(completed_date) as month')
            ->selectRaw('count(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('count','month')
            ->toArray();
    }

    public function render()
    {
        return view('livewire.components.transaction-bar-chart');
    }
}
