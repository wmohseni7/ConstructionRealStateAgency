<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agency;
use App\Models\Companies;
use Illuminate\Support\Facades\Validator;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.Companies.index', ['Agency' => Agency::get(), 'Companies'=>Companies::get(
        )]);
    }
    public function company(){
        $comps=Companies::all();
        return response()->json([
            'data'=>$comps,
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
            'agency_id'         => 'required',
            'name'              => 'required',
            'phone_number'      => 'required|min:9|max:13',
            'address'           => 'required',
            'owner'             => 'required',
        ],[
            'agency_id.required'         => 'نمایندگی را انتخاب نمایید',
            'name.required'              => 'اسم کمپنی را وارد کنید',
            'phone_number.required'      => 'شماره تماس کمپنی ضروری است',
            'phone_number.min'           => 'شماره تماس اشتباه است',
            'phone_number.max'           => 'شماره تماس اشتباه است',
            'address.required'           => 'آدرس کمپنی را وارد کنید',
            'owner.required'             => 'اسم صاحب امتیاز کمپنی را وارد کنید',
        ]);

        if ($validation->passes()) {
            $Agency= [
                'agency_id'     => $request->input('agency_id'),
                'name'          => $request->input('name'),
                'phone_number'  => $request->input('phone_number'),
                'address'       => $request->input('address'),
                'owner'         => $request->input('owner'),
            ]; 
            $inserted  = Companies::create($Agency);
            if($inserted)
            {
                return response()->json(['success' => 'کمپنی موفقانه اضافه شد']);
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
        $comps=Companies::find($id);
        return response()->json([
            'companies'=>$comps,
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
            'agency_id'        => 'required',
            'name'             => 'required',
            'phone_number'     => 'required',
            'address'          => 'required',
            'owner'            => 'required',
        ],[
            'agency_id.required'         => 'نمایندگی را انتخاب نمایید',
            'name.required'              => 'اسم کمپنی را وارد کنید',
            'phone_number.required'      => 'شماره تماس کمپنی ضروری است',
            'phone_number.min'           => 'شماره تماس اشتباه است',
            'phone_number.max'           => 'شماره تماس اشتباه است',
            'address.required'           => 'آدرس کمپنی را وارد کنید',
            'owner.required'             => 'اسم صاحب امتیاز کمپنی را وارد کنید',
        ]);

        if ($validation->passes()) {
            $updated= Companies::where('id',$request->input('company_id'))->update( [
                'agency_id'       => $request->input('agency_id'),
                'name'            => $request->input('name'),
                'phone_number'    => $request->input('phone_number'),
                'address'         => $request->input('address'),
                'owner'           => $request->input('owner'),
            ]); 
            if($updated)
            {
                return response()->json(['success' => ' تغییرات در مشخصات کمپنی موفقانه اعمال شد']);
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
        Companies::find($id)->delete();
    }
}
