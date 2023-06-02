<?php

namespace App\Http\Livewire\Components;

use App\Models\Categories;
use App\Models\Transaction;
use Carbon\Carbon;
use Livewire\Component;

class CategoryPieChart extends Component
{
    public $account;

    public $pieMethod;
    public $selectedRadio;

    public $transactions;

    public $pieChartValues = [];
    public $pieChartNames = [];
    public $pieChartColors = [];

    public $categories;

    protected $listeners =  [
        'refreshPieChart'
    ];

    public function refreshPieChart(){
        $this->updatedSelectedRadio();
    }

    public function mount()
    {

        $this->categories = Categories::all();

        $this->selectedRadio = "month";
        $this->pieMethod = false;

        if ($this->pieMethod)
            $this->transactions = Transaction::where('account_id', $this->account->id)->where('amount', '>', 0)->where('completed_date', '>=', Carbon::now()->subMonth()->format('Y-m-d'))->orderBy('completed_date')->get();
        else
            $this->transactions = Transaction::where('account_id', $this->account->id)->where('amount', '<', 0)->where('completed_date', '>=', Carbon::now()->subMonth()->format('Y-m-d'))->orderBy('completed_date')->get();

        $this->buildPieChartData($this->transactions);

    }

    public function updatedSelectedRadio()
    {
        switch ($this->selectedRadio) {
            case 'week':
                if ($this->pieMethod)
                    $this->transactions = Transaction::where('account_id', $this->account->id)->where('amount', '>', 0)->where('completed_date', '>=', Carbon::now()->subWeek()->format('Y-m-d'))->orderBy('completed_date')->get();
                else
                    $this->transactions = Transaction::where('account_id', $this->account->id)->where('amount', '<', 0)->where('completed_date', '>=', Carbon::now()->subWeek()->format('Y-m-d'))->orderBy('completed_date')->get();
                $this->buildPieChartData($this->transactions);
                break;
            case 'month':
                if ($this->pieMethod)
                    $this->transactions = Transaction::where('account_id', $this->account->id)->where('amount', '>', 0)->where('completed_date', '>=', Carbon::now()->subMonth()->format('Y-m-d'))->orderBy('completed_date')->get();
                else
                    $this->transactions = Transaction::where('account_id', $this->account->id)->where('amount', '<', 0)->where('completed_date', '>=', Carbon::now()->subMonth()->format('Y-m-d'))->orderBy('completed_date')->get();

                $this->buildPieChartData($this->transactions);
                break;
            case 'months':
                if ($this->pieMethod)
                    $this->transactions = Transaction::where('account_id', $this->account->id)->where('amount', '>', 0)->where('completed_date', '>=', Carbon::now()->subMonths(3)->format('Y-m-d'))->orderBy('completed_date')->get();
                else
                    $this->transactions = Transaction::where('account_id', $this->account->id)->where('amount', '<', 0)->where('completed_date', '>=', Carbon::now()->subMonths(3)->format('Y-m-d'))->orderBy('completed_date')->get();
                $this->buildPieChartData($this->transactions);
                break;
            case 'year':

                if ($this->pieMethod)
                    $this->transactions = Transaction::where('account_id', $this->account->id)->where('amount', '>', 0)->where('completed_date', '>=', Carbon::now()->subYear()->format('Y-m-d'))->orderBy('completed_date')->get();
                else
                    $this->transactions = Transaction::where('account_id', $this->account->id)->where('amount', '<', 0)->where('completed_date', '>=', Carbon::now()->subYear()->format('Y-m-d'))->orderBy('completed_date')->get();
                $this->buildPieChartData($this->transactions);
                break;
            case 'all':
                if ($this->pieMethod)
                    $this->transactions = Transaction::where('account_id', $this->account->id)->where('amount','>',0)->orderBy('completed_date')->get();
                else
                    $this->transactions = Transaction::where('account_id', $this->account->id)->where('amount','<',0)->orderBy('completed_date')->get();
                $this->buildPieChartData($this->transactions);
                break;
        }


//        $this->buildChartData($this->transactions, $this->amount, $this->selectedRadio);

        $this->emit('updateChart');
    }

    public function updatedPieMethod()
    {
        $this->updatedSelectedRadio();
    }

    public function buildPieChartData($transactions)
    {


        $this->pieChartNames = [];
        $this->pieChartColors = [];
        $this->pieChartValues = [];

        foreach ($transactions as $transaction) {
            if ($transaction->category_id) {
                if (array_key_exists($transaction->category_id, $this->pieChartValues)) {
                    $this->pieChartValues[$transaction->category_id] += $transaction->amount;
                } else {
                    $this->pieChartValues[$transaction->category_id] = $transaction->amount;

                }
            }
        }

        foreach ($this->pieChartValues as $key => $value) {
            $this->pieChartNames[$key] = $this->categories->where('id', $key)->first()->category_name;
        }

        foreach ($this->pieChartValues as $key => $value) {
            $this->pieChartColors[$key] = $this->categories->where('id', $key)->first()->category_color;
        }

    }

    public function render()
    {
        return view('livewire.components.category-pie-chart');
    }
}
