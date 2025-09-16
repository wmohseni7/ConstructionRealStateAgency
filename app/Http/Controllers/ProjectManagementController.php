<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agency;
use App\Models\Project;
use Illuminate\Support\Facades\Validator;

class ProjectManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.project management.index',['agencies'=>Agency::get()], ['projects'=>Project::get()]);
    }
    public function projects(){
        $projects=Project::all();
        return response()->json([
            'data'=>$projects,
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
            'agency_id'    => 'required',
            'name'         => 'required',
            'address'      => 'required',
            'type'         => 'required',
            'area'         => 'required',
            'unit'         => 'required',
            'floor'        => 'required',
            'apartment'    => 'required',
            'unitPrice'    => 'required',
            'total'        => 'required',
            'paid'         => 'required',
            'remain'       => 'required',
            'date'         => 'required|before:tomorrow',
            'description'  => 'required',
        ],[
            'agency_id.required'    => 'نمایندگی را انتخاب نمایید',
            'name.required'         => 'اسم پروژه را وارد نمایید',
            'address.required'      => 'آدرس را وارد نمایید',
            'type.required'         => 'نوعیت پروژه را انتخاب نمایید',
            'area.required'         => 'مساحت پروژه را وارد نمایید',
            'unit.required'         => 'واحد را انتخاب نمایید',
            'floor.required'        => 'تعداد طبقات را وارد نمایید',
            'apartment.required'    => ' تعداد واحد را وارد نمایید',
            'unitPrice.required'    => 'قیمت فی واحد را وارد نمایید',
            'total.required'        => 'مجموع مبلغ را وارد نمایید',
            'paid.required'         => 'مبلغ پرداخت شده را وارد نمایید',
            'remain.required'       => ' مبلغ باقی را وارد نمایید',
            'date.required'         => 'تاریخ اخذ پروژه را وارد نمایید',
            'date.before'           => 'تاریخ اخذ پروژه باید امروز و یا قبل از امروز باشد',
            'description.required'  => 'توضیحات پروژه را وارد نمایید',

        ]);
        if ($validation->passes()) {
            $property=[
            'agency_id'     => $request->input('agency_id'),
            'name'          => $request->input('name'),
            'address'       => $request->input('address'),
            'type'          => $request->input('type'),
            'area'          => $request->input('area'),
            'unit'          => $request->input('unit'),
            'floor'         => $request->input('floor'),
            'apartment'     => $request->input('apartment'),
            'unitPrice'     => $request->input('unitPrice'),
            'total'         => $request->input('total'),
            'paid'          => $request->input('paid'),
            'remain'        => $request->input('remain'),
            'date'          => $request->input('date'),
            'description'   => $request->input('description'),
            ];
            $inserted=Project::create($property);
            if ($inserted) {
                return response()->json(['success'=>'معامله موفقانه ثبت شد']);
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
        $project=Project::find($id);
        return response()->json([
            'projects'=>$project,
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
            'agency_id'    => 'required',
            'name'         => 'required',
            'address'      => 'required',
            'type'         => 'required',
            'area'         => 'required',
            'unit'         => 'required',
            'floor'        => 'required',
            'apartment'    => 'required',
            'unitPrice'    => 'required',
            'total'        => 'required',
            'paid'         => 'required',
            'remain'       => 'required',
            'date'         => 'required|before:tomorrow',
            'description'  => 'required',
        ],[
            'agency_id.required'    => 'نمایندگی را انتخاب نمایید',
            'name.required'         => 'اسم پروژه را وارد نمایید',
            'address.required'      => 'آدرس را وارد نمایید',
            'type.required'         => 'نوعیت پروژه را انتخاب نمایید',
            'area.required'         => 'مساحت پروژه را وارد نمایید',
            'unit.required'         => 'واحد را انتخاب نمایید',
            'floor.required'        => 'تعداد طبقات را وارد نمایید',
            'apartment.required'    => ' تعداد واحد را وارد نمایید',
            'unitPrice.required'    => 'قیمت فی واحد را وارد نمایید',
            'total.required'        => 'مجموع مبلغ را وارد نمایید',
            'paid.required'         => 'مبلغ پرداخت شده را وارد نمایید',
            'remain.required'       => ' مبلغ باقی را وارد نمایید',
            'date.required'         => 'تاریخ اخذ پروژه را وارد نمایید',
            'date.before'           => 'تاریخ اخذ پروژه باید امروز و یا قبل از امروز باشد',
            'description.required'  => 'توضیحات پروژه را وارد نمایید',
        ]);
        if ($validation->passes()) {
            $project=Project::where('id',$request->input('project_id'))->update([
            'agency_id'     => $request->input('agency_id'),
            'name'          => $request->input('name'),
            'address'       => $request->input('address'),
            'type'          => $request->input('type'),
            'area'          => $request->input('area'),
            'unit'          => $request->input('unit'),
            'floor'         => $request->input('floor'),
            'apartment'     => $request->input('apartment'),
            'unitPrice'     => $request->input('unitPrice'),
            'total'         => $request->input('total'),
            'paid'          => $request->input('paid'),
            'remain'        => $request->input('remain'),
            'date'          => $request->input('date'),
            'description'   => $request->input('description'),
            ]);
            if ($project) {
                return response()->json(['success'=>'تغییرات موفقانه اعمال شد']);
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
        Project::find($id)->delete();
    }
}
