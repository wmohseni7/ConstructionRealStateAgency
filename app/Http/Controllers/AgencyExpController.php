<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agency;
use App\Models\AgencyExp;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AgencyExpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.agency.expenditures.index',['agencies' => Agency::get()]);
    }
    public function expense()
    {
        $expense = DB::table('agency_exps')
                    ->join('agencies','agency_exps.agency_id','=','agencies.id')
                    ->select('agency_exps.*','agencies.name')
                    ->get();
        // $expense= AgencyExp::all();
        return response()->json([
            'data' => $expense,
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
            'amount'        => 'required',
            'date'          => 'required|before:tomorrow',
            'description'   => 'required',
        ],[
            'agency_id.required'     => 'نمایندگی را انتخاب نمایید',
            'amount.required'        => 'مبلغ را وارد نمایید',
            'date.required'          => 'تاریخ ثبت مصرف را وارد نمایید',
            'date.before'            => 'تاریخ باید امروز یا قبل از امروز باشد',
            'description.required'   => 'توضیحات برای وضاحت  ضروری است',
        ]);
        if ($validation->passes()) {
            $agency_exp             = new AgencyExp();
            $agency_exp->agency_id  = $request->input('agency_id');
            $agency_exp->amount     = $request->input('amount');
            $agency_exp->date       = $request->input('date');
            $agency_exp->description= $request->input('description');


            if ($agency_exp->save())
            {
                return response()->json(['success'=>'مصرف موفقانه اضافه شد']);
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
        $edited= AgencyExp::find($id);
        return response()->json([
            'agencyExp'=>$edited,
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
            'amount'        => 'required',
            'date'          => 'required|before:tomorrow',
            'description'   => 'required'
        ],[
            'agency_id.required'    => 'نمایندگی را انتخاب نمایید',
            'amount.required'       => 'مبلغ را وارد نمایید',
            'date.required'         => 'تاریخ ثبت مصرف را وارد نمایید',
            'date.before'           => 'تاریخ باید امروز یا قبل از امروز باشد',
            'description.required'  => 'توضیحات برای وضاحت  ضروری است',
        ]);
        if ($validation->passes()) {
            $agency_exp             = AgencyExp::find($id);
            $agency_exp->agency_id  = $request->input('agency_id');
            $agency_exp->amount     = $request->input('amount');
            $agency_exp->date       = $request->input('date');
            $agency_exp->description= $request->input('description');

            if($agency_exp->save())
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
        AgencyExp::find($id)->delete();
    }
}
