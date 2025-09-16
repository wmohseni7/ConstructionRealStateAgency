<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\AltClaims;

class AltClaimsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $claims = AltClaims::get();
        return view('pages.Dealings management.AltClaims.index',['claims'=>$claims]);
    }
    public function claims()
    {
        $claims=AltClaims::all();
        return response()->json([
            'data'=>$claims,
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
            'name.required'        => 'اسم شخص قرضدار ضروری است',
            'amount.required'      => 'مبلغ قرض ضروری است',
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
            $inserted  = AltClaims::create($AltClaim);
            if($inserted)
            {
                return response()->json(['success' => 'طلب موفقانه اضافه شد']);
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
        $claims=AltClaims::find($id);
        return response()->json([
            'claims'=>$claims,
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
            'name.required' => 'name is required now'
        ]);

        if ($validation->passes()) {
            $updated=AltClaims::where('id',$request->input('toEdit_id'))->update( [
                'name'          => $request->input('name'),
                'amount'        => $request->input('amount'),
                'date'          => $request->input('date'),
                'description'   => $request->input('description'),
            ],[
                'name.required'        => 'اسم شخص قرضدار ضروری است',
                'amount.required'      => 'مبلغ قرض ضروری است',
                'date.before'          => 'تاریخ باید قبل از امروز یا امروز باشد',
                'date.required'        => 'تاریخ قرض را وارد کنید',
                'description.required' => 'توضیحات قرض را وارد کنید',
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
        AltClaims::find($id)->delete();
    }
}
