<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
    public function show(){
        return view('pages.accounts.list');
    }

    public function details(Account $account){
        return view('pages.accounts.details',['account' => $account]);
    }
}
