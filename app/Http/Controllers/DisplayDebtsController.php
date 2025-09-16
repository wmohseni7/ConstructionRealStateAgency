<?php

namespace App\Http\Controllers;

use App\Models\projectConstruction;
use Illuminate\Http\Request;

class DisplayDebtsController extends Controller
{
    public function index(){
        $debts = projectConstruction::where('remain','>',0)->get();
        return view('pages.Dealings management.debts .index',['debts'=> $debts]);
    }
}
