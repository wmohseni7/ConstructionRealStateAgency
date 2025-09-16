<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agency;
use App\Models\Dealership;
use Illuminate\Support\Facades\Validator;
use App\Models\Properties;

class PropertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('pages.Properties.index', ['agencies'=>Agency::get()],['properties'=>Properties::get()]);
    }
    public function properties(){
        $properties=Properties::all();
        return response()->json([
            'data'=>$properties,
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
            'name'          => 'required',
            'address'       => 'required',
            'floor'         => 'required',
            'apartment'     => 'required',
            
        ],[
            'agency_id.required'    => 'نمایندگی را انتخاب نمایید',
            'name.required'         => 'اسم ملک را وارد نمایید',
            'address.required'      => 'آدرس ملک را وارد نمایید',
            'floor.required'        => 'تعداد طبقات را وارد نمایید',
            'apartment.required'    => 'تعداد واحد ها را وارد نمایید',
        ]);
        // $title = time().'.'.$request()->file->getClientOriginalExtension();
        // $request->file->move(public_path('assets/images/dealedProperties',$title));
        if ($validation->passes()) {
            $property=[
            'agency_id'     => $request->input('agency_id'),
            'name'          => $request->input('name'),
            'floor'         => $request->input('floor'),
            'apartment'     => $request->input('apartment'),
            'address'       => $request->input('address'),
            
            ];
            $inserted=Properties::create($property);
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
       $properties=Properties::find($id);
       return response()->json([
            'properties'=>$properties,
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
            'agency_id'     => 'required',
            'name'          => 'required',
            'address'       => 'required',
            'floor'         => 'required',
            'apartment'     => 'required',
        ]);
        if ($validation->passes()) {
            $updated=Properties::where('id',$request->input('property_id'))->update([
            'agency_id'     => $request->input('agency_id'),
            'name'          => $request->input('name'),
            'address'       => $request->input('address'),
            'floor'         => $request->input('floor'),
            'apartment'     => $request->input('apartment'),
            ],[
                'agency_id.required'    => 'نمایندگی را انتخاب نمایید',
                'name.required'         => 'اسم ملک را وارد نمایید',
                'address.required'      => 'آدرس ملک را وارد نمایید',
                'floor.required'        => 'تعداد طبقات را وارد نمایید',
                'apartment.required'    => 'تعداد واحد ها را وارد نمایید',
            ]);
            if ($updated) {
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
        Properties::find($id)->delete();
    }
}
