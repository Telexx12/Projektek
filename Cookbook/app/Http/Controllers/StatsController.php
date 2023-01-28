<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function statsview(){
        return view('pages.stats');
    }
}
