<?php

namespace App\Http\Livewire;

use App\Imports\OTPImport;
use App\Models\Account;
use App\Models\AccountType;
use App\Models\BankType;
use App\Models\Transaction;
use App\View\Components\auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Accounts extends Component
{

    use WithFileUploads, LivewireAlert;

    public $accountName;
    public $selectedType;

    public $accountTypes;
    public $banks;
    public $bank;
    public $editAccountModal = false;

    public $createAccountModal;

    public $edit_details = true;

    public $importFile;
    public $fileName;

    public $comparisonBasic = [];

    public $selectedAccount;

    protected $listeners = [
        'deleteAccount',
        'refreshComponent' => '$refresh',
    ];


    public function mount(){
        $this->accountTypes = AccountType::all();
        $this->banks = BankType::all();
    }

    public function updatedComparisonBasic(){
        $this->getAccounts();
    }

    public function comparisonBasicChecked($id,$value){
        if(array_key_exists($id,$this->comparisonBasic)){
            if($this->comparisonBasic[$id] == $value){
                return true;
            }else{
                return false;
            }
        }else{
            if($value == 'month'){
                return true;
            }else{
                return false;
            }
        }
    }

    public function getAccounts(){
        return Account::query()
            ->select('id','account_name','user_id','bank_id')
            ->user(auth()->user()->id)
            ->with('bank:id,icon_name,bank_name')
            ->amount()
            ->monthlyCheck()
            ->weeklyCheck()
            ->dailyCheck()
            ->get();
    }

    public function updatedImportFile(){
       $this->validate([
          'importFile' => 'nullable|mimes:csv,xlsx'
       ]);
    }


    public function selectComparisonBasic($value){
        $this->comparisonBasic = $value;
    }

    public function createAccount(){
         $rules = [
            'accountName' => 'required|unique:accounts,account_name',
            'selectedType' => 'required',
        ];

         $credit_card_id = $this->accountTypes->where('account_type','Credit card')->pluck('id')->first();

         if($this->selectedType == $credit_card_id){
             $rules['bank'] = 'required';
             $rules['importFile'] = 'nullable|mimes:csv,xlsx';

         }

        $this->validate($rules);


         $crated_account = Account::create([
             'user_id' => auth()->user()->id,
             'account_name' => $this->accountName,
             'bank_id' => $this->bank,
             'account_type_id' => $this->selectedType,
         ]);

        if(!is_null($this->importFile)){
            Excel::import(importHandler($crated_account),$this->importFile);
        }

         $this->createAccountModal = false;

         $this->reset('bank','accountName','importFile');


         $this->selectedType = 1;

        $this->emit('refreshComponent');

    }

    public function calculateChange($present,$past){
        if(is_null($present))
            return '-';

        if($past == $present)
            return '0.00%';

        if(is_null($past) || $past == 0){
            return 100;
        }

        $percent_change = (($present - $past) / $past) * 100;

        return number_format($percent_change,'2') . '%';
    }


    public function open(){
        $this->createAccountModal=true;
//        $this->selectedType = 1;
//        $this->accountName = null;
    }

    public function deleteAccount($data){
        Account::find($data['data']['id'])->delete();
        $this->emit('refreshComponent');
    }
    public function confirmDelete($id, $name){

        $this->alert('warning',__('accounts.delete_account',['name' => $name]), [
            'position' => 'center',
            'data' => ['id' => $id],
            'timer' => '',
            'toast' => false,
            'showConfirmButton' => true,
            'onConfirmed' => 'deleteAccount',
            'showCancelButton' => true,
            'width' => '30%',
        ]);
    }

    public function editAccount($id){
        $account = Account::where('id', $id)->first();

        $this->selectedType = $account->account_type_id;
        $this->accountName = $account->account_name;


        $credit_card_id = $this->accountTypes->where('account_type','Credit card')->pluck('id')->first();

        if($this->selectedType == $credit_card_id){
            $this->edit_details = true;
            $this->bank = $account->bank_id;
        }else{
            $this->edit_details = false;
        }


        $this->selectedAccount = $id;

        $this->editAccountModal = true;
    }

    public function saveEditedAccount($id){
        $account =  Account::where('id',$id)->first();

        $rules = [
            'selectedType' => 'required',
        ];

        $credit_card_id = $this->accountTypes->where('account_type','Credit card')->pluck('id')->first();

        if($this->selectedType == $credit_card_id){
            $rules['bank'] = 'required';
        }
        if($this->accountName != $account->account_name){
            $rules['accountName'] = 'required|unique:accounts,account_name';
        }

        $this->validate($rules);


        Account::where('id',$id)->update([
           'account_name' => $this->accountName,
           'account_type_id' => $this->selectedType,
            'bank_id' => $this->bank,
        ]);

        $this->reset('bank','accountName','importFile');


        $this->selectedType = 1;
        $this->getAccounts();
        $this->emit('refreshComponent');
        $this->editAccountModal = false;
    }


    public function render()
    {

        return view('livewire.accounts', ['accounts' => $this->getAccounts()]);
    }
}
