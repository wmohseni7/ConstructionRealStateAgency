<?php

namespace App\Http\Controllers;

use App\Models\AltDebts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AltDebtsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $debts= AltDebts::get();
        return view('pages.Dealings management.AltDebts.index',['debts'=> $debts]);
    }
    public function debts()
    {
        $debts=AltDebts::all();
        return response()->json([
            'data'=>$debts,
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
            'name'          => 'required',
            'amount'        => 'required',
            'date'          => 'required|before:tomorrow',
            'description'   => 'required',
        ],[
            'name.required'        => 'اسم شخص را وارد کنید',
            'amount.required'      => 'مبلغ قرض را وارد کنید ',
            'date.required'        => 'تاریخ قرض را وارد کنید',
            'date.before'          => 'تاریخ باید قبل از امروز و یا امروز باشد',
            'description.required' => 'توضیحات قرض را وارد کنید',
        ]);

        if ($validation->passes()) {
            $AltClaim= [
                'name'          => $request->input('name'),
                'amount'        => $request->input('amount'),
                'date'          => $request->input('date'),
                'description'   => $request->input('description'),
            ]; 
            $inserted  = AltDebts::create($AltClaim);
            if($inserted)
            {
                return response()->json(['success' => 'قرض موفقانه اضافه شد']);
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
        $debts=AltDebts::find($id);
        return response()->json([
            'debts'=>$debts,
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
            'name'          => 'required',
            'amount'        => 'required',
            'date'          => 'required|before:tomorrow',
            'description'   => 'required',
        ],[
            'name.required'        => 'اسم شخص را وارد کنید',
            'amount.required'      => 'مبلغ قرض را وارد کنید ',
            'date.required'        => 'تاریخ قرض را وارد کنید',
            'date.before'          => 'تاریخ باید قبل از امروز و یا امروز باشد',
            'description.required' => 'توضیحات قرض را وارد کنید',
        ]);

        if ($validation->passes()) {
            $updated=AltDebts::where('id',$request->input('toEdit_id'))->update( [
                'name'          => $request->input('name'),
                'amount'        => $request->input('amount'),
                'date'          => $request->input('date'),
                'description'   => $request->input('description'),
            ],[

            ]); 
            if($updated)
            {
                return response()->json(['success' => 'تغییرات موفقانه اعمال شد']);
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
        AltDebts::find($id)->delete();
    }
}
