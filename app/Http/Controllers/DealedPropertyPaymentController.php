<?php

namespace App\Http\Controllers;

use App\Models\DealedPropertyPayment;
use App\Models\Dealership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DealedPropertyPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $routeId                = ((int)$request->route('id'));
        $project                = Dealership::find($routeId);
        $dealedPropertyPayment  = DealedPropertyPayment::where('dealership_id','=',$routeId)->get();
        return view('pages.Properties.Deals.DealedPropertyPayment.index',['dealedProperty'=>$project],['dealedPropertyPayment'=>$dealedPropertyPayment]);
    }
    public function payment(){
        $payment=DealedPropertyPayment::all();
        return response()->json([
            'data'=>$payment,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'dealership_id' => 'required',
            'name'          => 'required',
            'total'         => 'required',
            'date'          => 'required|before:tomorrow',
            'paid'          => 'required',
        ],[
            'date.required' => 'تاریخ پرداختی ضروری می باشد',
            'date.before'   => 'تاریخ باید قبل از امروز و یا امروز باشد',
            'paid.required' => 'مبلغ پرداخت شده را وارد کنید',
        ]);

        if ($validation->passes()) {
            $dealedPropertyPayment= [
                'dealership_id' => $request->input('dealership_id'),
                'name'          => $request->input('name'),
                'total'         => $request->input('total'),
                'date'          => $request->input('date'),
                'paid'          => $request->input('paid'),
                'remain'        => $request->input('remain'),
            ]; 
            $inserted  = DealedPropertyPayment::create($dealedPropertyPayment);
            if($inserted)
            {
                return response()->json(['success' => 'پرداختی موفقانه اضافه شد']);
            }
        }
        else
        {
            return response()->json(['error' => $validation->errors()->all()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payment=DealedPropertyPayment::find($id);
        return response()->json([
            'payment'=>$payment,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(),[
            'date'                => 'required|before:tomorrow',
            'paid'                => 'required',
        ],[
            'paid.required' => 'مبلغ باقی را وارد نمایید',
            'date.required' => 'تاریخ را وارد نمایید',
            'date.before'   => 'تاریخ باید امروز و یا قبل از امروز باشد',
        ]);

        if ($validation->passes()) {
            $updated=DealedPropertyPayment::where('id',$request->input('dealedProperty_id'))->update( [
                'date'                => $request->input('date'),
                'paid'                => $request->input('paid'),
                'remain'              => $request->input('remain'),
            ]); 
            if($updated)
            {
                return response()->json(['success' => ' تغییرات پرداختی موفقانه اعمال شد']);
            }
        }
        else
        {
            return response()->json(['error' => $validation->errors()->all()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DealedPropertyPayment::find($id)->delete();
    }
}
