<?php

namespace App\Http\Livewire\Components;

use App\Models\Transaction;
use Carbon\Carbon;
use Livewire\Component;

class CashLineChart extends Component
{

    public $account;


    public $transactions;

    public $amount;

    public $chartDatas = [];

    public $selectedRadio;

    public $from;
    public $add;
    public $default;

    protected $listeners = [
        'transactionAdded',
    ];

    public function mount()
    {

        $this->selectedRadio = "month";


        $this->transactions = Transaction::where('account_id', $this->account->id)->where('completed_date', '>=', Carbon::now()->subMonth()->format('Y-m-d'))->get()->groupBy('completed_date')->toArray();

        $this->amount = Transaction::where('account_id', $this->account->id)->where('completed_date', '<', Carbon::now()->subMonth()->format('Y-m-d'))->sum('amount');

        $this->buildChartDataMonth($this->transactions, $this->amount);


    }

    public function transactionAdded(){

//        dd('teszt');

        $this->updatedSelectedRadio();
    }


    public function updatedSelectedRadio()
    {
        switch ($this->selectedRadio) {
            case 'week':
                $this->transactions = Transaction::where('account_id', $this->account->id)->where('completed_date', '>=', Carbon::now()->subWeek()->format('Y-m-d'))->orderBy('completed_date')->get()->groupBy('completed_date')->toArray();
                $this->amount = Transaction::where('account_id', $this->account->id)->where('completed_date', '<', Carbon::now()->subWeek()->format('Y-m-d'))->sum('amount');
                $this->buildChartDataWeek($this->transactions, $this->amount);
                break;
            case 'month':
                $this->transactions = Transaction::where('account_id', $this->account->id)->where('completed_date', '>=', Carbon::now()->subMonth()->format('Y-m-d'))->orderBy('completed_date')->get()->groupBy('completed_date')->toArray();
                $this->amount = Transaction::where('account_id', $this->account->id)->where('completed_date', '<', Carbon::now()->subMonth()->format('Y-m-d'))->sum('amount');
                $this->buildChartDataMonth($this->transactions, $this->amount);
                break;
            case 'months':
                $this->transactions = Transaction::where('account_id', $this->account->id)->where('completed_date', '>=', Carbon::now()->subMonths(3)->format('Y-m-d'))->orderBy('completed_date')->get()->groupBy('completed_date')->toArray();
                $this->amount = Transaction::where('account_id', $this->account->id)->where('completed_date', '<', Carbon::now()->subMonths(3)->format('Y-m-d'))->sum('amount');
                $this->buildChartData($this->transactions, $this->amount);
                break;
            case 'year':
                $this->transactions = Transaction::where('account_id', $this->account->id)->where('completed_date', '>=', Carbon::now()->subYear()->format('Y-m-d'))->orderBy('completed_date')->get()->groupBy('completed_date')->toArray();
                $this->amount = Transaction::where('account_id', $this->account->id)->where('completed_date', '<', Carbon::now()->subYear()->format('Y-m-d'))->sum('amount');
                $this->buildChartDataYear($this->transactions, $this->amount);
                break;
            case 'all':
                $this->transactions = Transaction::where('account_id', $this->account->id)->orderBy('completed_date')->get()->groupBy('completed_date')->toArray();
                $this->buildChartDataAll($this->transactions);
                break;


        }


//        $this->buildChartData($this->transactions, $this->amount, $this->selectedRadio);

        $this->emit('updateChart');
    }


    protected function buildChartDataAll($transactions)
    {
        $this->chartDatas = [];
        $current_amount = 0;



        $last_date = array_key_first($transactions);

        for ($date = Carbon::parse($last_date); $date <= Carbon::now(); $date->addDay()) {

            $day = $date->format('Y-m-d');

            if (array_key_exists($date->format('Y-m-d'), $this->transactions)) {
                $change = 0;
                foreach ($this->transactions[$date->format('Y-m-d')] as $transaction) {
                    $change += $transaction["amount"];
                }
                $current_amount += $change;
            }
            $this->chartDatas[$day] = $current_amount;
        }

    }


    protected function buildChartData($transactions, $amount)
    {
        $this->chartDatas = [];
        $current_amount = $amount;


        for ($date = Carbon::now()->subMOnths(3); $date <= Carbon::now(); $date->addDay()) {

            $day = $date->format('Y-m-d');

            if (array_key_exists($date->format('Y-m-d'), $this->transactions)) {
                $change = 0;
                foreach ($this->transactions[$date->format('Y-m-d')] as $transaction) {
                    $change += $transaction["amount"];
                }
                $current_amount += $change;
            }

            $this->chartDatas[$day] = $current_amount;
        }

    }


    protected function buildChartDataYear($transactions, $amount)
    {
        $this->chartDatas = [];
        $current_amount = $amount;


        for ($date = Carbon::now()->subYear(); $date <= Carbon::now(); $date->addDay()) {

            $day = $date->format('Y-m-d');

            if (array_key_exists($date->format('Y-m-d'), $this->transactions)) {
                $change = 0;
                foreach ($this->transactions[$date->format('Y-m-d')] as $transaction) {
                    $change += $transaction["amount"];
                }
                $current_amount += $change;
            }

            $this->chartDatas[$day] = $current_amount;
        }

    }


    protected function buildChartDataMonth($transactions, $amount)
    {
        $this->chartDatas = [];
        $current_amount = $amount;


        for ($date = Carbon::now()->subMonth(); $date <= Carbon::now(); $date->addDay()) {

            $day = $date->format('Y-m-d');

            if (array_key_exists($date->format('Y-m-d'), $this->transactions)) {
                $change = 0;
                foreach ($this->transactions[$date->format('Y-m-d')] as $transaction) {
                    $change += $transaction["amount"];
                }
                $current_amount += $change;
            }

            $this->chartDatas[$day] = $current_amount;
        }

    }


    protected function buildChartDataWeek($transactions, $amount)
    {
        $this->chartDatas = [];
        $current_amount = $amount;

//        dd($transactions,$amount);

        for ($date = Carbon::now()->subWeek(); $date <= Carbon::now(); $date->addDay()) {

            $day = $date->format('Y-m-d');

            if (array_key_exists($date->format('Y-m-d'), $this->transactions)) {
                $change = 0;
                foreach ($this->transactions[$date->format('Y-m-d')] as $transaction) {
                    $change += $transaction["amount"];
                }
                $current_amount += $change;
            }

            $this->chartDatas[$day] = $current_amount;
        }
    }

    public function render()
    {
        return view('livewire.components.cash-line-chart');
    }
}
