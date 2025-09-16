<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agency;
use App\Models\HomeExp;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class HomeExpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.PersonalExpenditures.index',['agencies'=>Agency::get()],['agenciesHomeExp'=>HomeExp::get()]);
    }

    public function homeExp(){
        // $homeExp= HomeExp::all();
        $homeExp = DB::table('home_exps')
                    ->join('agencies','home_exps.agency_id','=','agencies.id')
                    ->select('home_exps.*','agencies.name')
                    ->get();
        return response()->json([
            'data'=>$homeExp,
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
        $validation= Validator::make($request->all(),[
            'agency_id'     => 'required',
            'sender'        => 'required',
            'receiver'      => 'required',
            'amount'        => 'required',
            'date'          => 'required|before:tomorrow',
            'description'   => 'required',
        ],[
            'agency_id.required'  => 'نمایندگی را انتخاب نمایید',
            'sender.required'     => 'اسم فرستنده را وارد کنید',
            'receiver.required'   => 'اسم گیرنده را وارد کنید',
            'amount.required'     => 'مبلغ مصرف را وارد کنید',
            'date.required'       => 'تاریخ ثبت مصرف را وارد کنید',
            'date.before'         => 'تاریخ برداشت مصرف باید امروز و یا قبل از امروز باشد',
            'description.required'=> 'توضیحات را وارد کنید',
        ]);
        if ($validation->passes()) {
            $expend=[
            'agency_id'      => $request->input('agency_id'),
            'sender'         => $request->input('sender'),
            'receiver'       => $request->input('receiver'),
            'amount'         => $request->input('amount'),
            'date'           => $request->input('date'),
            'description'    => $request->input('description'),
            ];
            $inserted=HomeExp::create($expend);
            if ($inserted) {
                return response()->json(['success' => 'مصرف موفقانه اضافه شد']);
            }
        }
        else{
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
        $homeExp=HomeExp::find($id);
        return response()->json([
            'homeExp'=>$homeExp,
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
            'agency_id'     => 'required',
            'sender'        => 'required',
            'receiver'      => 'required',
            'amount'        => 'required',
            'date'          => 'required|before:tomorrow',
            'description'   => 'required'
        ],[
            'agency_id.required'  => 'نمایندگی را انتخاب نمایید',
            'sender.required'     => 'اسم فرستنده را وارد کنید',
            'receiver.required'   => 'اسم گیرنده را وارد کنید',
            'amount.required'     => 'مبلغ مصرف را وارد کنید',
            'date.required'       => 'تاریخ ثبت مصرف را وارد کنید',
            'date.before'         => 'تاریخ برداشت مصرف باید امروز و یا قبل از امروز باشد',
            'description.required'=> 'توضیحات را وارد کنید',
        ]);
        if ($validation->passes()) {
            $updated  = HomeExp::where('id',$request->input('agencyHomeExp_id'))->update([
                'agency_id'     => $request->input('agency_id'),
                'sender'        => $request->input('sender'),
                'receiver'      => $request->input('receiver'),
                'amount'        => $request->input('amount'),
                'date'          => $request->input('date'),
                'description'   => $request->input('description'),
            ]);

            if($updated){
                return response()->json(['success' => 'تغییرات موفقانه اعمال شد']);
            }
        }
        else{
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
        HomeExp::find($id)->delete();
    }
}
