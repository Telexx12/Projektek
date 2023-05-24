<?php

namespace App\Http\Livewire;

use App\Imports\OTPImport;
use App\Models\Transaction;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard');
    }
}
