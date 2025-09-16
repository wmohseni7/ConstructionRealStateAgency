<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\SweetAlertServiceProvider;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;


class AgencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $agencies=Agency::get();

        return view('pages.agency.index');
    }
    public function fetchagencies()
    {
        $agencies= Agency::all();
        return response()->json([
            'data'=> $agencies,
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
            'owner'         => 'required',
            'address'       => 'required',
            'status'        => 'required',
            'phone_number'  => 'required|min:10|max:12'
        ],[
            'name.required'        => 'اسم نمایندگی ضروری میباشد',
            'owner.required'       => 'اسم مسئول نمایندگی ضروری میباشد',
            'address.required'     => 'آدرس نمایندگی ضروری میباشد',
            'status.required'      => 'وضعیت نمایندگی باید ثبت شود',
            'phone_number.required'=> 'شماره تماس باید ثبت شود و درست باشد',
        ]);

        if ($validation->passes()) {
            $Agency= [
                'name'          =>$request->input('name'),
                'owner'         =>$request->input('owner'),
                'address'       =>$request->input('address'),
                'status'        =>$request->input('status'),
                'phone_number'  =>$request->input('phone_number'),
            ]; 
            $inserted  = Agency::create($Agency);
            if($inserted){
                return response()->json(['success' =>'نمایندگی موفقانه اضافه شد']);
            }
        }
            else{
                return response()->json(['error' => $validation->errors()->all()]);
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function show(Agency $agency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $agencies=Agency::find($id);
        return response()->json([
            'agencies'=> $agencies,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {        
        $validation = Validator::make($request->all(),[
            'name'          =>'required',
            'owner'         =>'required',
            'address'       =>'required',
            'status'        =>'required',
            'phone_number'  =>'required|min:10|max:12'
        ],[
            'name.required'         => 'اسم نمایندگی ضروری میباشد',
            'owner.required'        => 'اسم مسئول نمایندگی ضروری میباشد',
            'address.required'      => 'آدرس نمایندگی ضروری میباشد',
            'status.required'       => 'وضعیت نمایندگی باید ثبت شود',
            'phone_number.required' => 'شماره تماس باید ثبت شود و درست باشد',
        ]);

        if ($validation->passes()) {
            $updated  = Agency::where('id',$request->input('agency_id'))->update([
                'name'          => $request->input('name'),
                'owner'         => $request->input('owner'),
                'address'       => $request->input('address'),
                'status'        => $request->input('status'),
                'phone_number'  => $request->input('phone_number'),
            ]);
            if($updated){
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
     * @param  \App\Models\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Agency::find($id)->delete();
    }
}
