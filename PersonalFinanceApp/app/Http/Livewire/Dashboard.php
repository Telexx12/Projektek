<?php

namespace App\Http\Livewire;

use App\Imports\TransactionsImport;
use App\Models\Transaction;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Dashboard extends Component
{

    use WithFileUploads, LivewireAlert;

    public $importFile;
    public $transactions;
    public $total_income;
    public $total_expens;
    public $current_balance;

    public function mount(){
        $this->transactions = $this->getTransactions();

        $this->total_income = $this->getTotalIncome($this->transactions);
        $this->total_expens = $this->getTotalExpens($this->transactions);
        $this->current_balance = $this->total_income - $this->total_expens;
    }

    public function getTransactions(){
        return Transaction::all();
    }

    public function getTotalIncome($transactions){
        $income = 0;
        foreach ($transactions as $transaction){
            if($transaction->amount > 0){
                $income += $transaction->amount;
            }
        }
        return $income;
    }

    public function getTotalExpens($transactions){
        $expens = 0;
        foreach ($transactions as $transaction){
            if($transaction->amount < 0){
                $expens += $transaction->amount;
            }
        }
        return $expens * -1;
    }



    public function updatedImportFile(){
        $this->validate([
           'importFile' => 'mimes:csv,xlsx',
        ]);

        Excel::import(new TransactionsImport(),$this->importFile);
        $this->alert('success', 'User created!', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => false,
        ]);

    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
