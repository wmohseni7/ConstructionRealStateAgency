<?php

namespace App\Http\Controllers;

use App\Models\DealedPropertyPayment;
use App\Models\Dealership;
use App\Models\Properties;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DealershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $routeId          = ((int)$request->route('id'));
        $property         = Properties::find($routeId);
        $dealership       = Dealership::where('properties_id' ,'=', $routeId)->get();
        return view('pages.Properties.Deals.index',['property' => $property, 'dealership'=>$dealership]);
    }
    public function Deals(){

        
        // return response()->json([
        //     'data'=>$dealership,
        // ]);
        // return response()->json([
        //     'data'=>$dealership,
        // ]);
        // return response()->json(array('body' => View::make('pages.Properties.Deals.index',compact('property'))->render(), 'data' => $dealership));
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
    if($request->input('editDealedProperty_id'))
        {
            $validation1= Validator::make($request->all(),[
                'customer'     => 'required',
                'phone_number' => 'required|min:9|max:13',
                'floorNum'     => 'required',
                'apartmentNum' => 'required',
                'deal'         => 'required',
                'amount'       => 'required',
                'photo'        => 'image|mimes:jpeg,jpg,png,gif|max:100000',
                'description'  => 'required',
                'date'         => 'required|before:tomorrow',
            ],[
                'customer.required'     => 'اسم مشتری را وارد کنید',
                'phone_number.required' => 'شماره تماس مشتری را وارد کنید',
                'phone_number.min'      => 'شماره تماس اشتباه می باشد',
                'phone_number.max'      => 'شماره تماس اشتباه می باشد',
                'floorNum.required'     => 'شماره طبقه را وارد کنید',
                'apartmentNum.required' => 'شماره واحد را وارد کنید',
                'deal.required'         => 'نوعیت معامله را وارد کنید',
                'amount.required'       => 'مقدار پرداختی را وارد کنید',
                'photo.image'           => 'فایل آپلود شده بابد عکس باشد',
                'photo.mimes'           => 'پسوند فایل اپلود شده باید jpeg,jpg,png,gif باشد',
                'photo.max'             => 'سایز عکس حداکثر ۱۰ مگابایت باید باشد',
                'description.required'  => 'توضیحات ضروری  می باشد',
                'date.required'         => 'تاریخ قرارداد ضروری می باشد',
                'date.before'           => 'تاریخ قرارداد باید امروز و یا قبل از امروز باشد',
                
            ]);

            if ($validation1->passes())
            {
                if($request->hasFile('photo'))
                {
                    $dealership=Dealership::find($request->input('editDealedProperty_id'));
                    unlink($dealership->photo);
                    
                    $extension      = $request->file('photo')->getClientOriginalExtension();
                    $dir            = 'assets/storage/images/properties/';
                    $filename       = uniqid().'_'. time(). '.' . $extension;
                    $request->file('photo')->move($dir,$filename);
                    $image_name     = $dir.$filename;

                    $updated= Dealership::where('id',$request->input('editDealedProperty_id'))->update([
                    'properties_id' => $request->input('property_id'),
                    'name'          => $request->input('name'),
                    'floor'         => $request->input('floor'),
                    'apartment'     => $request->input('apartment'), 
                    'customer'      => $request->input('customer'),
                    'phone_number'  => $request->input('phone_number'),
                    'floorNum'      => $request->input('floorNum'),
                    'apartmentNum'  => $request->input('apartmentNum'),
                    'deal'          => $request->input('deal'),
                    'amount'        => $request->input('amount'),
                    'photo'         => $image_name,
                    'description'   => $request->input('description'),
                    'date'          => $request->input('date'),
                    ]);
                    // $inserted=Dealership::create($property);
                    if ($updated) {
                        return response()->json([ 'success' => 'تغییرات موفقانه اعمال شد']);
                    }
                    else{
                        return response()->json([ 'error' => $validation1->errors()->all()]);
                    }
                }
                else
                {
                    $updated2= Dealership::where('id',$request->input('editDealedProperty_id'))->update([
                    'properties_id' => $request->input('property_id'),
                    'name'          => $request->input('name'),
                    'floor'         => $request->input('floor'),
                    'apartment'     => $request->input('apartment'), 
                    'customer'      => $request->input('customer'),
                    'phone_number'  => $request->input('phone_number'),
                    'floorNum'      => $request->input('floorNum'),
                    'apartmentNum'  => $request->input('apartmentNum'),
                    'deal'          => $request->input('deal'),
                    'amount'        => $request->input('amount'),
                    'description'   => $request->input('description'),
                    'date'          => $request->input('date'),
                    ]);
                    // $inserted=Dealership::create($property);
                    if ($updated2) {
                        return response()->json([ 'success' => 'تغییرات موفقانه اعمال شد']);
                    }
                    else{
                        return response()->json(['error' => $validation1->errors()->all()]);
                    }
                }
                
            }
    
                
        }
        else
        {
            $validation= Validator::make($request->all(),[
                'customer'     => 'required',
                'phone_number' => 'required|min:9|max:13',
                'floorNum'     => 'required',
                'apartmentNum' => 'required',
                'deal'         => 'required',
                'amount'       => 'required',
                'photo'        => 'required|image|mimes:jpeg,jpg,png,gif|max:100000',
                'description'  => 'required',
                'date'         => 'required|before:tomorrow',
            ],[
                'customer.required'     => 'اسم مشتری را وارد کنید',
                'phone_number.required' => 'شماره تماس مشتری را وارد کنید',
                'phone_number.min'      => 'شماره تماس اشتباه می باشد',
                'phone_number.max'      => 'شماره تماس اشتباه می باشد',
                'floorNum.required'     => 'شماره طبقه را وارد کنید',
                'apartmentNum.required' => 'شماره واحد را وارد کنید',
                'deal.required'         => 'نوعیت معامله را وارد کنید',
                'amount.required'       => 'مقدار پرداختی را وارد کنید',
                'photo.required'        => 'عکس قرارداد را آپلود کنید',
                'photo.image'           => 'فایل آپلود شده بابد عکس باشد',
                'photo.mimes'           => 'پسوند فایل اپلود شده باید jpeg,jpg,png,gif باشد',
                'photo.max'             => 'سایز عکس حداکثر ۱۰ مگابایت باید باشد',
                'description.required'  => 'توضیحات ضروری  می باشد',
                'date.required'         => 'تاریخ قرارداد ضروری می باشد',
                'date.before'           => 'تاریخ قرارداد باید امروز و یا قبل از امروز باشد',
                
            ]);
            if ($validation->passes()) {

                $extension      = $request->file('photo')->getClientOriginalExtension();
                $dir            = 'assets/storage/images/properties/';
                $filename       = uniqid().'_'. time(). '.' . $extension;
                $request->file('photo')->move($dir,$filename);
                $image_name     = $dir.$filename;


                $property=[
                'properties_id' => $request->input('property_id'),
                'name'          => $request->input('name'),
                'floor'         => $request->input('floor'),
                'apartment'     => $request->input('apartment'), 
                'customer'      => $request->input('customer'),
                'phone_number'  => $request->input('phone_number'),
                'floorNum'      => $request->input('floorNum'),
                'apartmentNum'  => $request->input('apartmentNum'),
                'deal'          => $request->input('deal'),
                'amount'        => $request->input('amount'),
                'photo'         => $image_name,
                'description'   => $request->input('description'),
                'date'          => $request->input('date'),
                ];
                $inserted=Dealership::create($property);
                if ($inserted) {
                    return response()->json([ 'success' => 'معامله موفقانه اضافه شد']);
                }
            }
            else{
                return response()->json(['error' => $validation->errors()->all()]);
            }
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
        $dealerships = Dealership::find($id);
        return response()->json([
            'DealerImage'=>$dealerships,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $data= Dealership::find($id);
       return response()->json([
            'dealerships'=>$data,
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dealership = Dealership::find($id);
        unlink($dealership->photo);
        Dealership::find($id)->delete();
    }
}
