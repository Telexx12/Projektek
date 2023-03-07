<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;
    public $remember_token;

    public function mount(){
        $this->remember_token = false;
    }

    public function submit(){
       $credentials = $this->validate([
           'email' => 'email|required',
            'password' => 'required',
        ]);


       if(Auth::attempt($credentials,$this->remember_token)){
           $this->redirect('/');
       }
       $errors = $this->getErrorBag();
       $errors->add('user','user not found');
    }

    public function render()
    {
        return view('livewire.login');
    }
}
