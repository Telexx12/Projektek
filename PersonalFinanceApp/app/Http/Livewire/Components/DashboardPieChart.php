<?php

namespace App\Http\Livewire\Components;

use App\Models\Categories;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DashboardPieChart extends Component
{

    public $pieMethod;
    public $selectedRadio;

    public $transactions;

    public $pieChartValues = [];
    public $pieChartNames = [];
    public $pieChartColors = [];

    public $categories;

    protected $listeners =  [
        'refreshPieChart',
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
//            $this->transactions = Transaction::where('user_id', auth()->user()->id)->where('amount', '>', 0)->where('completed_date', '>=', Carbon::now()->subMonth()->format('Y-m-d'))->orderBy('completed_date')->get();
            $this->transactions = Transaction::query()
                ->select('category_id',DB::raw('SUM(amount) as sum'))
                ->whereNotNull('category_id')
                ->where('completed_date', '>=', Carbon::now()->subMonth()->format('Y-m-d'))
                ->where('user_id', auth()->user()->id)->where('amount', '>', 0)
                ->groupBy('category_id')
                ->pluck('sum','category_id')
                ->toArray();
        else
            $this->transactions = Transaction::query()
                ->select('category_id',DB::raw('SUM(amount) as sum'))
                ->whereNotNull('category_id')
                ->where('completed_date', '>=', Carbon::now()->subMonth()->format('Y-m-d'))
                ->where('user_id', auth()->user()->id)->where('amount', '<', 0)
                ->groupBy('category_id')
                ->pluck('sum','category_id')
                ->toArray();



        $this->buildPieChartData($this->transactions);

    }

    public function updatedSelectedRadio()
    {
        switch ($this->selectedRadio) {
            case 'week':
                if ($this->pieMethod)
                    $this->transactions = Transaction::query()
                        ->select('category_id',DB::raw('SUM(amount) as sum'))
                        ->whereNotNull('category_id')
                        ->where('completed_date', '>=', Carbon::now()->subWeek()->format('Y-m-d'))
                        ->where('user_id', auth()->user()->id)->where('amount', '>', 0)
                        ->groupBy('category_id')
                        ->pluck('sum','category_id')
                        ->toArray();
                else
                    $this->transactions = Transaction::query()
                        ->select('category_id',DB::raw('SUM(amount) as sum'))
                        ->whereNotNull('category_id')
                        ->where('completed_date', '>=', Carbon::now()->subWeek()->format('Y-m-d'))
                        ->where('user_id', auth()->user()->id)->where('amount', '<', 0)
                        ->groupBy('category_id')
                        ->pluck('sum','category_id')
                        ->toArray();
                $this->buildPieChartData($this->transactions);
                break;
            case 'month':
                if ($this->pieMethod){
                    $this->transactions = Transaction::query()
                        ->select('category_id',DB::raw('SUM(amount) as sum'))
                        ->whereNotNull('category_id')
                        ->where('completed_date', '>=', Carbon::now()->subMonth()->format('Y-m-d'))
                        ->where('user_id', auth()->user()->id)->where('amount', '>', 0)
                        ->groupBy('category_id')
                        ->pluck('sum','category_id')
                        ->toArray();
                }
                else
                    $this->transactions = Transaction::query()
                        ->select('category_id',DB::raw('SUM(amount) as sum'))
                        ->whereNotNull('category_id')
                        ->where('completed_date', '>=', Carbon::now()->subMonth()->format('Y-m-d'))
                        ->where('user_id', auth()->user()->id)->where('amount', '<', 0)
                        ->groupBy('category_id')
                        ->pluck('sum','category_id')
                        ->toArray();

                $this->buildPieChartData($this->transactions);
                break;
            case 'months':
                if ($this->pieMethod)
                    $this->transactions = Transaction::query()
                        ->select('category_id',DB::raw('SUM(amount) as sum'))
                        ->whereNotNull('category_id')
                        ->where('completed_date', '>=', Carbon::now()->subMonths(3)->format('Y-m-d'))
                        ->where('user_id', auth()->user()->id)->where('amount', '>', 0)
                        ->groupBy('category_id')
                        ->pluck('sum','category_id')
                        ->toArray();
                else
                    $this->transactions = Transaction::query()
                        ->select('category_id',DB::raw('SUM(amount) as sum'))
                        ->whereNotNull('category_id')
                        ->where('completed_date', '>=', Carbon::now()->subMonths(3)->format('Y-m-d'))
                        ->where('user_id', auth()->user()->id)->where('amount', '<', 0)
                        ->groupBy('category_id')
                        ->pluck('sum','category_id')
                        ->toArray();
                $this->buildPieChartData($this->transactions);
                break;
            case 'year':

                if ($this->pieMethod)
                    $this->transactions = Transaction::query()
                        ->select('category_id',DB::raw('SUM(amount) as sum'))
                        ->whereNotNull('category_id')
                        ->where('completed_date', '>=', Carbon::now()->subYear()->format('Y-m-d'))
                        ->where('user_id', auth()->user()->id)->where('amount', '>', 0)
                        ->groupBy('category_id')
                        ->pluck('sum','category_id')
                        ->toArray();
                else
                    $this->transactions = Transaction::query()
                        ->select('category_id',DB::raw('SUM(amount) as sum'))
                        ->whereNotNull('category_id')
                        ->where('completed_date', '>=', Carbon::now()->subYear()->format('Y-m-d'))
                        ->where('user_id', auth()->user()->id)->where('amount', '<', 0)
                        ->groupBy('category_id')
                        ->pluck('sum','category_id')
                        ->toArray();
                $this->buildPieChartData($this->transactions);
                break;
            case 'all':
                if ($this->pieMethod)
                    $this->transactions = Transaction::query()
                        ->select('category_id',DB::raw('SUM(amount) as sum'))
                        ->whereNotNull('category_id')
                        ->where('user_id', auth()->user()->id)->where('amount', '>', 0)
                        ->groupBy('category_id')
                        ->pluck('sum','category_id')
                        ->toArray();
                else
                    $this->transactions = Transaction::query()
                        ->select('category_id',DB::raw('SUM(amount) as sum'))
                        ->whereNotNull('category_id')
                        ->where('user_id', auth()->user()->id)->where('amount', '<', 0)
                        ->groupBy('category_id')
                        ->pluck('sum','category_id')
                        ->toArray();
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

        foreach ($this->transactions as $key => $value) {
            $this->pieChartValues[$key] = $value < 0 ? $value * -1 : $value ;
        }

        foreach ($this->transactions as $key => $value) {
            $this->pieChartNames[$key] = $this->categories->where('id', $key)->first()->category_name;
        }

        foreach ($this->transactions as $key => $value) {
            $this->pieChartColors[$key] = $this->categories->where('id', $key)->first()->category_color;
        }

    }
    public function render()
    {
        return view('livewire.components.dashboard-pie-chart');
    }
}
