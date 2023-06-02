<?php

namespace App\Http\Livewire\Components;

use App\Models\Transaction;
use Carbon\Carbon;
use Livewire\Component;

class DashboardTransactions extends Component
{

    public $number_of_transactions;

    public $transactions;


    public $search_category;
    public $search_time;

    public $categories;

    public function mount(){

        $this->number_of_transactions = 5;

        $this->getTransactions();

        $this->categories = auth()->user()->categories;
    }


    public function clearFilters(){
        $this->search_category = null;
        $this->search_time = null;
        $this->getTransactions();
    }

    public function getTransactions(){
        $this->transactions = Transaction::where('user_id',auth()->user()->id)
            ->when($this->search_category, function($query,$search_category){
                $query->where('category_id',$search_category);
            })
            ->when($this->search_time,function($query,$search_time){
                switch ($search_time){
                     case 'week':
                         $query->where('completed_date', '>=', Carbon::now()->subWeek()->format('Y-m-d'));
                         break;
                    case 'month':
                        $query->where('completed_date', '>=', Carbon::now()->subMonth()->format('Y-m-d'));
                        break;
                    case 'months':
                        $query->where('completed_date', '>=', Carbon::now()->subMonths(3)->format('Y-m-d'));
                        break;
                    case 'year':
                        $query->where('completed_date', '>=', Carbon::now()->subYear()->format('Y-m-d'));
                        break;
                }

            })
            ->orderBy('completed_date','desc')->take($this->number_of_transactions)
            ->get();
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
