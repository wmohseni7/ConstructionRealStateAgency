<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\Employees;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agencies  = Agency::get();
        $projects  = Project::get();
        $employees = Employees::get();
        return view('pages.EmployeesManagement.index',['agencies'=>$agencies],['projects'=>$projects])->with(['employees'=>$employees]);
    }
    public function employees(){
        // $employees = DB::table('employees')
        //             ->join('projects','employees.project_id','=','projects.id')
        //             ->select('employees.*','project.name')
        //             ->get();
        $employees=Employees::all();
        return response()->json([
            'data'=>$employees,
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
            'agency'        => 'required',
            'project'       => 'required',
            'name'          => 'required',
            'phone_number'  => 'required|min:9|max:13', 
            'address'       => 'required',
            'title'         => 'required',
            'total'         => 'required',
            'paid'          => 'required',
            'date'          => 'required|before:tomorrow',
        ],[
            'agency.required'       => 'نمایندگی را انتخاب نمایید',
            'project.required'      => 'پروژه را انتخاب نمایید',
            'name.required'         => 'اسم کارمند را وارد نمایید',
            'phone_number.required' => 'شماره تماس ضروری می باشد',
            'phone_number.min'      => 'شماره تماس اشتباه می باشد',
            'phone_number.max'      => 'شماره تماس اشتباه می باشد',
            'address.required'      => 'آدرس را وارد کنید',
            'title.required'        => 'عنوان شغل را انتخاب نماید',
            'total.required'        => 'مجموع پرداختی را وارد کنید',
            'paid.required'         => 'مبلغ پرداخت شده را وارد کنید',
            'date.required'         => 'تاریخ را وارد کنید',
            'date.before'           => 'تاریخ باید امروز و یا قبل از امروز باشد',

        ]);
        if ($validation->passes()) {
            $emp=[
            'agency_id'      => $request->input('agency'),
            'project_id'     => $request->input('project'),
            'name'           => $request->input('name'),
            'phone_number'   => $request->input('phone_number'),
            'address'        => $request->input('address'),
            'title'          => $request->input('title'),
            'total'          => $request->input('total'),
            'paid'           => $request->input('paid'),
            'remain'         => $request->input('remain'),
            'date'           => $request->input('date'),
            ];
            $inserted=Employees::create($emp);
            if ($inserted) {
                return response()->json(['success' => 'کارمند موفقانه اضافه شد']);
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
        $employees= Employees::find($id);
        return response()->json([
            'employees'=>$employees,
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
        $validation= Validator::make($request->all(),[
            'agency'        => 'required',
            'project'       => 'required',
            'name'          => 'required',
            'phone_number'  => 'required',
            'address'       => 'required',
            'title'         => 'required',
            'total'         => 'required',
            'paid'          => 'required',
            'remain'        => 'required',
            'date'          => 'required|before:tomorrow',
        ]);
        if ($validation->passes()) {
            $updated= Employees::where('id',$request->input('Employee_id'))->update([
            'agency_id'      => $request->input('agency'),
            'project_id'     => $request->input('project'),
            'name'           => $request->input('name'),
            'phone_number'   => $request->input('phone_number'),
            'address'        => $request->input('address'),
            'title'          => $request->input('title'),
            'total'          => $request->input('total'),
            'paid'           => $request->input('paid'),
            'remain'         => $request->input('remain'),
            'date'           => $request->input('date'),
            ],[
            'agency.required'       => 'نمایندگی را انتخاب نمایید',
            'project.required'      => 'پروژه را انتخاب نمایید',
            'name.required'         => 'اسم کارمند را وارد نمایید',
            'phone_number.required' => 'شماره تماس ضروری می باشد',
            'phone_number.min'      => 'شماره تماس اشتباه می باشد',
            'phone_number.max'      => 'شماره تماس اشتباه می باشد',
            'address.required'      => 'آدرس را وارد کنید',
            'title.required'        => 'عنوان شغل را انتخاب نماید',
            'total.required'        => 'مجموع پرداختی را وارد کنید',
            'paid.required'         => 'مبلغ پرداخت شده را وارد کنید',
            'date.required'         => 'تاریخ را وارد کنید',
            'date.before'           => 'تاریخ باید امروز و یا قبل از امروز باشد',
            ]);
            if ($updated) {
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
        Employees::find($id)->delete();
    }
}
