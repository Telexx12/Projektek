<?php

namespace App\Http\Livewire\Components;

use App\Models\Categories;
use App\Models\Transaction;
use App\View\Components\auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class TransactionCard extends Component
{

    use LivewireAlert;

    public $transaction;

    public $comment;

    public $categories;


    protected $listeners = [
        'refreshComponent' => '$refresh',
        'confirmedDelete'
    ];

    public function mount(){
        $this->createTransactionModal = false;
        $this->comment = $this->transaction->comment;

        $this->categories = auth()->user()->categories;

    }


    public function updatedComment(){
       $this->transaction->update([
           'comment' => $this->comment
       ]);

       $this->emit('refreshComponent');


    }

    public function deleteTransaction(){

        $this->alert('warning',__('transaction.delete'), [
            'position' => 'center',
            'timer' => '',
            'toast' => false,
            'showConfirmButton' => true,
            'onConfirmed' => 'confirmedDelete',
            'showCancelButton' => true,
            'width' => '30%',
            'cancelButtonText' => __('common.no'),
            'confirmButtonText' => __('common.yes'),
        ]);
    }
    public function deletePhoneTransaction(){

        $this->alert('warning',__('transaction.delete'), [
            'position' => 'center',
            'timer' => '',
            'toast' => false,
            'showConfirmButton' => true,
            'onConfirmed' => 'confirmedDelete',
            'showCancelButton' => true,
            'width' => '100%',
            'cancelButtonText' => __('common.no'),
            'confirmButtonText' => __('common.yes'),
        ]);
    }

    public function confirmedDelete(){
        Transaction::query()->where('id',$this->transaction->id)->delete();
        $this->emitUp('transactionDeleted');
    }

    public function deleteComment(){
        $this->comment = null;


        $this->transaction->update([
            'comment' => null
        ]);
    }



    public function render()
    {
        return view('livewire.components.transaction-card');
    }
}
