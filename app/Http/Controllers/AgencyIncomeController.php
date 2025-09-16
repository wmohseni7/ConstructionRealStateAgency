<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\AgencyIncome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AgencyIncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.agency.income.index', ['agencies' => Agency::get()]);
    }

    
    public function income()
    {
        // $agenciesIncome= AgencyIncome::all();
        $agenciesIncome = DB::table('agency_incomes')
                    ->join('agencies','agency_incomes.agency_id','=','agencies.id')
                    ->select('agency_incomes.*','agencies.name')
                    ->get();
        return response()->json(
        [
              'data'=> $agenciesIncome,
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
            'agency_id'     => 'required',
            'amount'        => 'required',
            'duration'      => 'required',
            'date'          => 'required|before:tomorrow',
            'description'   => 'required',
        ],[
            'agency_id.required'   => 'نمایندگی را انتخاب نمایید',
            'amount.required'      => 'مبلغ ضروری می باشد',
            'duration.required'    => 'مدت زمان درآمد را به روز بنویسید',
            'date.required'        => 'تاریخ اخذ درآمد ضروری است',
            'date.before'          => 'تاریخ باید امروز و یا قبل از امروز باشد',
            'description.required' => 'توضیحات برای وضاحت ضروری است ',
        ]);

        if ($validation->passes()) {
            $Agency= [
                'agency_id'     => $request->input('agency_id'),
                'amount'        => $request->input('amount'),
                'duration'      => $request->input('duration'),
                'date'          => $request->input('date'),
                'description'   => $request->input('description'),
            ]; 
            $inserted  = AgencyIncome::create($Agency);
            if($inserted)
            {
                return response()->json(['success' => 'درآمد موفقانه اضافه شد']);
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $income=AgencyIncome::find($id);
        return response()->json([
            'AgencyIncome'=> $income,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'agency_id'     => 'required',
            'amount'        => 'required',
            'duration'      => 'required',
            'date'          => 'required|before:tomorrow',
            'description'   => 'required'
        ],[
            'agency.required' => 'agency is required now'
        ]);
        if ($validation->passes()) {
            $updated  = AgencyIncome::where('id',$request->input('agencyIncome_id'))->update([
                'agency_id'     => $request->input('agency_id'),
                'amount'        => $request->input('amount'),
                'duration'      => $request->input('duration'),
                'date'          => $request->input('date'),
                'description'   => $request->input('description'),
            ],[
                'agency_id.required'   => 'نمایندگی را انتخاب نمایید',
                'amount.required'      => 'مبلغ ضروری می باشد',
                'duration.required'    => 'مدت زمان درآمد را به روز بنویسید',
                'date.required'        => 'تاریخ اخذ درآمد ضروری است',
                'date.before'          => 'تاریخ باید امروز و یا قبل از امروز باشد',
                'description.required' => 'توضیحات برای وضاحت ضروری است ',
            ]);

            if($updated){
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
        // dd($id);
        AgencyIncome::find($id)->delete();

    }
}
