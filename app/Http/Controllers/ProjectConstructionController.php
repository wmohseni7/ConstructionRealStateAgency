<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\projectConstruction;
use App\Models\Companies;
use Illuminate\Support\Facades\Validator;

class ProjectConstructionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $projects    = Project::find((int) $request->route('id'));
        $company     = Companies::get();
        $constructed = projectConstruction::where('project_id', (int)$request -> route('id'))->get();
        return view('pages.project management.construction.index', [
            'projects'        => $projects, 
            'constructed'     => $constructed,
            'companies'       => $company, 
        ]);
    }
    public function projectsConst(){
        $projectConst=projectConstruction::all();
        return response()->json([
            'data'=>$projectConst,
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
        // dd($request);
        $validation= Validator::make($request->all(),[
            'project_id'   => 'required',
            'categories'   => 'required',
            'name'         => 'required',
            'amount'       => 'required',
            'type'         => 'required',
            'price'        => 'required',
            'company'      => 'required',
            'total'        => 'required',
            'paid'         => 'required',
            'date'         => 'required|before:tomorrow',
            'bill'         => 'required',
            'currency'     => 'required',
            'description'  => 'required',
        ],[
            'project_id.required'   => 'پروژه را انتخاب نمایید',
            'categories.required'   => 'کتگوری را انتخاب نمایید',
            'name.required'         => 'اسم مورد مصرفی را وارد نمایید',
            'amount.required'       => 'مقدار مورد مصرفی را وارد نمایید',
            'type.required'         => 'نوعیت مورد مصرفی را انتخاب نمایید',
            'price.required'        => 'قیمت فی مورد مصرفی را وارد نمایید',
            'company.required'      => 'کمپنی مورد مصرفی را انتخاب نمایید',
            'total.required'        => 'مبلغ محموعی مورد مصرفی را وارد نمایید',
            'paid.required'         => 'مبلغ پرداخت شده را وارد نمایید',
            'date.required'         => 'تاریخ اخذ مواد را وارد نمایید',
            'date.before'           => 'تاریخ باید امروز و یا قبل از امروز باشد',
            'bill.required'         => 'بل نمبر را وارد نمایید',
            'currency.required'     => ' واحد پولی را انتخاب نمایید',
            'description.required'  => 'توضیحات ضروری میباشد',
        ]);
        if ($validation->passes()) {
            $property=[
            'project_id'  => $request->input('project_id'),
            'category'    => $request->input('categories'),
            'name'        => $request->input('name'),
            'amount'      => $request->input('amount'),
            'type'        => $request->input('type'),
            'price'       => $request->input('price'),
            'company_id'  => $request->input('company'),
            'total'       => $request->input('total'),
            'paid'        => $request->input('paid'),
            'remain'      => $request->input('remain'),
            'date'        => $request->input('date'),
            'bill'        => $request->input('bill'),
            'currency'    => $request->input('currency'),
            'description' => $request->input('description'),
            ];
            $inserted=projectConstruction::create($property);
            if ($inserted) {
                return response()->json(['success'=>'مصرف موفقانه ثبت شد']);
            }
        }
        else{
            return response()->json([
                'error' => $validation->errors()->all()
            ]);
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
        $constructions=projectConstruction::find($id);
        return response()->json([
            'consts'=>$constructions,
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
            'project_id'   => 'required',
            'categories'   => 'required',
            'name'         => 'required',
            'amount'       => 'required',
            'type'         => 'required',
            'price'        => 'required',
            'company'      => 'required',
            'total'        => 'required',
            'paid'         => 'required',
            'date'         => 'required|before:tomorrow',
            'bill'         => 'required',
            'currency'     => 'required',
            'description'  => 'required',
        ],[
            'project_id.required'   => 'پروژه را انتخاب نمایید',
            'categories.required'   => 'کتگوری را انتخاب نمایید',
            'name.required'         => 'اسم مورد مصرفی را وارد نمایید',
            'amount.required'       => 'مقدار مورد مصرفی را وارد نمایید',
            'type.required'         => 'نوعیت مورد مصرفی را انتخاب نمایید',
            'price.required'        => 'قیمت فی مورد مصرفی را وارد نمایید',
            'company.required'      => 'کمپنی مورد مصرفی را انتخاب نمایید',
            'total.required'        => 'مبلغ محموعی مورد مصرفی را وارد نمایید',
            'paid.required'         => 'مبلغ پرداخت شده را وارد نمایید',
            'date.required'         => 'تاریخ اخذ مواد را وارد نمایید',
            'date.before'           => 'تاریخ باید امروز و یا قبل از امروز باشد',
            'bill.required'         => 'بل نمبر را وارد نمایید',
            'currency.required'     => ' واحد پولی را انتخاب نمایید',
            'description.required'  => 'توضیحات ضروری میباشد',
        ]);
        if ($validation->passes()) {
            $updated = projectConstruction::where('id',$request->input('edit_project_id'))->update([
            'project_id'  => $request->input('project_id'),
            'category'    => $request->input('categories'),
            'name'        => $request->input('name'),
            'amount'      => $request->input('amount'),
            'type'        => $request->input('type'),
            'price'       => $request->input('price'),
            'company_id'  => $request->input('company'),
            'total'       => $request->input('total'),
            'paid'        => $request->input('paid'),
            'remain'      => $request->input('remain'),
            'date'        => $request->input('date'),
            'bill'        => $request->input('bill'),
            'currency'    => $request->input('currency'),
            'description' => $request->input('description'),
            ]);
            if ($updated) {
                return response()->json(['success'=>'تغییرات موفقانه اعمال شد']);
            }
        }
        else{
            return response()->json([
                'error' => $validation->errors()->all()
            ]);
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
        projectConstruction::find($id)->delete();
    }
}
