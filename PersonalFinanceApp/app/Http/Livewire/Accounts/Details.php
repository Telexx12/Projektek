<?php

namespace App\Http\Livewire\Accounts;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Details extends Component
{
    use WithFileUploads, LivewireAlert;

    public $account;


    public $number_of_transactions;
    public $transactions;

    public $createTransactionModal;
    public $transactionMethod = "manual";   ///useless egyelőre

    public $transaction_completed_date;
    public $transaction_currency;
    public $transaction_amount;
    public $transaction_description;
    public $transaction_comment;

    public $rerenderChart = 0;

    public $categories;

    public $importFile;

    protected $listeners  = [
        'refreshComponent' => '$refresh',
        'transactionDeleted',
    ];


    public function mount(){

        $this->number_of_transactions = 5;

        $this->transactionMethod = true;

        $this->categories = auth()->user()->categories;

        $this->getTransactions();

    }

    public function openTransactionCreateModel(){
        $this->createTransactionModal = true;

        $this->transaction_currency = "RON";
    }

    public function transactionDeleted(){
        $this->emit('transactionAdded');
        $this->getTransactions();
    }

    public function getTransactions(){
        $this->transactions = Transaction::where('user_id',auth()->user()->id)->where('account_id', $this->account->id)->orderBy('completed_date','desc')->take($this->number_of_transactions)->get();

    }

    public function saveTransaction(){
        if($this->transactionMethod){
            $this->validate([
               'transaction_completed_date' => 'required',
//                'transaction_currency' => 'required',
                'transaction_amount'  => 'required',
            ]);

            $transaction = Transaction::create([
                'account_id'  => $this->account->id,
                'started_date' => $this->transaction_completed_date,
                'completed_date' => $this->transaction_completed_date,
                'description' => $this->transaction_description,
                'currency' => $this->transaction_currency,
                'amount' => $this->transaction_amount,
                'comment' => $this->transaction_comment,
                'user_id' => auth()->user()->id,
            ]);

            $this->createTransactionModal = false;

//            dd($transaction);

            $this->getTransactions();

            $this->emit('transactionAdded');


        }else{
            if(!is_null($this->importFile)){
                Excel::import(importHandler($this->account),$this->importFile);
            }

            $this->createTransactionModal = false;

            $this->getTransactions();

            $this->emit('transactionAdded');
            $this->emit('refreshPieChart');

        }
    }


    public function incrementNumberOfTransactions(){
        $this->number_of_transactions += 5;

        $this->getTransactions();

    }

    public function render()
    {
        return view('livewire.accounts.details');
    }
}
