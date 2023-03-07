<?php

namespace App\Http\Livewire;

use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Register extends Component
{
    use LivewireAlert;

    public $email;
    public $username;
    public $password;
    public  $password_confirmation;

    public function mount(){

    }

    public function submit(){

        $data = $this->validate([
           'email' => 'required|email|unique:users,email',
           'username' => 'required|min:3|unique:users,username',
            'password' => 'min:8|confirmed',
        ]);

        User::create($data);

        $this->alert('success', 'User created!', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => false,
        ]);

        $this->redirect('/');


    }

    public function render()
    {
        return view('livewire.register');
    }
}
