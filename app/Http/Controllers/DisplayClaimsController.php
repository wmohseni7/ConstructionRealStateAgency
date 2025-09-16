<?php

namespace App\Http\Controllers;

use App\Models\DealedPropertyPayment;
use Illuminate\Http\Request;

class DisplayClaimsController extends Controller
{
    public function index(){
        $claims = DealedPropertyPayment::where('remain','>',0)->get();
        return view('pages.Dealings management.claims.index',['claims'=>$claims]);
    }
}
