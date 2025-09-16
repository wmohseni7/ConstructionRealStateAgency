<?php

namespace App\Http\Controllers;

use App\Models\Partners;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PartnersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partners=Partners::get();
        return view('pages.PartnersManagment.index',['partners'=>$partners]);
    }
    public function partners(){
        $partner=Partners::all();
        return response()->json([
            'data'=>$partner,
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
            'last_name'     => 'required',
            'phone_number'  => 'required|min:9|max:13',
            'email'         => 'required',
            'address'       => 'required',
            'date'          => 'required|before:tomorrow',
            'description'   => 'required',
        ],[
            'name.required'         => 'اسم شریک را وارد کنید',
            'last_name.required'    => 'تخلص شریک را وارد کنید',
            'phone_number.required' => 'شماره تماس شریک را وارد کنید',
            'phone_number.min'      => 'شماره تماس اشتباه می باشد',
            'phone_number.max'      => 'شماره تماس اشتباه می باشد',
            'email.required'        => 'ایمیل را وارد کنید',
            'address.required'      => 'آدرس را وارد کنید',
            'date.required'         => 'تاریخ را وارد کنید',
            'date.before'           => 'تاریخ باید امروز یا قبل از امروز باشد',
            'description.required'  => 'توضیحات را وارد کنید',
        ]);
        if ($validation->passes()) {
            $partner=[
                'name'          => $request->input('name'),
                'last_name'     => $request->input('last_name'),
                'phone_number'  => $request->input('phone_number'),
                'email'         => $request->input('email'),
                'address'       => $request->input('address'),
                'date'          => $request->input('date'),
                'description'   => $request->input('description'),
            ];
               $inserted = Partners::Create($partner);
            if($inserted){
                return response()->json(['success' => 'شریک موفقانه اضافه شد']);
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
        $partners=Partners::find($id);
        return response()->json([
            'partners'=>$partners,
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
            'last_name'     => 'required',
            'phone_number'  => 'required',
            'email'         => 'required',
            'address'       => 'required',
            'date'          => 'required|before:tomorrow',
            'description'   => 'required',
        ],[
            'name.required' => 'agency is required now'
        ]);
        if ($validation->passes()) {
            $partner= Partners::where('id',$request->input('partner_id'))->update([
                'name'          => $request->input('name'),
                'last_name'     => $request->input('last_name'),
                'phone_number'  => $request->input('phone_number'),
                'email'         => $request->input('email'),
                'address'       => $request->input('address'),
                'date'          => $request->input('date'),
                'description'   => $request->input('description'),
            ],[
                'name.required'         => 'اسم شریک را وارد کنید',
                'last_name.required'    => 'تخلص شریک را وارد کنید',
                'phone_number.required' => 'شماره تماس شریک را وارد کنید',
                'phone_number.min'      => 'شماره تماس اشتباه می باشد',
                'phone_number.max'      => 'شماره تماس اشتباه می باشد',
                'email.required'        => 'ایمیل را وارد کنید',
                'address.required'      => 'آدرس را وارد کنید',
                'date.required'         => 'تاریخ را وارد کنید',
                'date.before'           => 'تاریخ باید امروز یا قبل از امروز باشد',
                'description.required'  => 'توضیحات را وارد کنید',
            ]);
            if($partner){
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
        Partners::find($id)->delete();
    }
}
