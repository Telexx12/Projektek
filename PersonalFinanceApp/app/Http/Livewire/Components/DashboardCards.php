<?php

namespace App\Http\Livewire\Components;

use App\Models\Transaction;
use App\View\Components\auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Database\Query\Builder;

class DashboardCards extends Component
{
    public $transactions;
    public $total_income;
    public $total_expens;
    public $current_balance;
    public $monthly_income;
    public $last_month_income;
    public $income_monthly_change;
    public $average_income;
    public $average_income_change;

    public $monthly_expens;
    public $last_month_expens;
    public $expens_monthly_change;
    public $average_expens;
    public $average_expense_change;

    public $last_month_balance;
    public $balance_change;


    public function mount()
    {
        $this->transactions = $this->getTransactions();

        $this->total_income = $this->getTotalIncome($this->transactions);
        $this->total_expens = $this->getTotalExpens($this->transactions);
        $this->current_balance = $this->total_income - $this->total_expens;

        $this->getMonthlyIncome();
        $this->getAverageIncome();

        $this->getMonthlyExpens();
        $this->getAverageExpens();

        $this->getLastMonthBalance();
    }

    public function getTransactions()
    {
        return Transaction::all();
    }

    public function getTotalIncome($transactions)
    {
        $income = 0;
        foreach ($transactions as $transaction) {
            if ($transaction->amount > 0) {
                $income += $transaction->amount;
            }
        }
        return $income;
    }

    public function getTotalExpens($transactions)
    {
        $expens = 0;
        foreach ($transactions as $transaction) {
            if ($transaction->amount < 0) {
                $expens += $transaction->amount;
            }
        }
        return $expens * -1;
    }

    public function getMonthlyIncome()
    {
        $month_transactions = $this->transactions->where('user_id', auth()->user()->id)
            ->where('amount','>',0)
            ->where('completed_date', '>=', Carbon::now()->subMonth()->format('Y-m-d'));

        $sum = 0;

        foreach ($month_transactions as $trans){
            $sum += $trans->amount;
        }
        $this->monthly_income = $sum;

        $sum = 0;

        $last_month_transactions = $this->transactions->where('user_id', auth()->user()->id)->where('amount','>',0)->where('completed_date', '>=', Carbon::now()->subMonths(2)->format('Y-m-d'))->where('completed_date','<',Carbon::now()->subMonth()->format('Y-m-d'));

        foreach ($last_month_transactions as $trans){
            $sum += $trans->amount;
        }

        $this->last_month_income = $sum;


        if($this->last_month_income != 0)
            $this->income_monthly_change = number_format((($this->monthly_income - $this->last_month_income)/$this->last_month_income) * 100,2);
        else
            $this->income_monthly_change = "NaN";
    }

    public function getAverageIncome(){

        $result = Transaction::query()
            ->select(DB::raw('AVG(x.sum) as avg'))
            ->fromSub(function ($query) {
                $query->select(DB::raw('SUM(amount) as sum'))
                    ->from('transactions')
                    ->where('amount', '>', 0)
                    ->groupBy(DB::raw('YEAR(completed_date), MONTH(completed_date)'));
            }, 'x')
            ->first();

        $this->average_income = $result->avg;


        if($this->average_income != 0)
            $this->average_income_change =  number_format((($this->monthly_income - $this->average_income)/$this->average_income) * 100,2);
        else
            $this->average_income_change = "NaN";
        $this->average_income = number_format($result->avg,2);

    }

    public function getMonthlyExpens(){
        $month_transactions = $this->transactions->where('user_id', auth()->user()->id)->where('amount','<',0)->where('completed_date', '>=', Carbon::now()->subMonth()->format('Y-m-d'));
        $sum = 0;

        foreach ($month_transactions as $trans){
            $sum += $trans->amount;
        }
        $this->monthly_expens = $sum * -1;

        $sum = 0;

        $last_month_transactions = $this->transactions->where('user_id', auth()->user()->id)->where('amount','<',0)->where('completed_date', '>=', Carbon::now()->subMonths(2)->format('Y-m-d'))->where('completed_date','<',Carbon::now()->subMonth()->format('Y-m-d'));

        foreach ($last_month_transactions as $trans){
            $sum += $trans->amount;
        }

        $this->last_month_expens = $sum * -1;


        if($this->last_month_expens != 0)
            $this->expens_monthly_change = number_format((($this->monthly_expens - $this->last_month_expens)/$this->last_month_expens) * 100,2);
        else
            $this->expens_monthly_change = "NaN";
    }

    public function getAverageExpens(){
        $result = Transaction::query()
            ->select(DB::raw('AVG(x.sum) as avg'))
            ->fromSub(function ($query) {
                $query->select(DB::raw('SUM(amount) as sum'))
                    ->from('transactions')
                    ->where('amount', '<', 0)
                    ->groupBy(DB::raw('YEAR(completed_date), MONTH(completed_date)'));
            }, 'x')
            ->first();

        $this->average_expens = $result->avg * -1;

        if($this->average_expens != 0)
            $this->average_expense_change =  number_format((($this->monthly_expens - $this->average_expens)/$this->average_expens) * 100,2);
        else
            $this->average_expense_change = "NaN";
        $this->average_expens = number_format($result->avg * -1,2);
    }

    public function getLastMonthBalance(){

        $transactions = $this->transactions->where('completed_date','<',Carbon::now()->subMonth()->format('Y-m-d'));
        $sum = 0;
        foreach ($transactions as $trans){
            $sum += $trans->amount;
        }

        $this->last_month_balance = $sum;

        if($this->last_month_balance != 0)
            $this->balance_change = number_format((($this->current_balance - $this->last_month_balance)/$this->last_month_balance) * 100,2);
        else
            $this->balance_change = "NaN";
    }

    public function render()
    {
        return view('livewire.components.dashboard-cards');
    }
}
