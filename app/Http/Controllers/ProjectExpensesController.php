<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectExpenses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $project    = Project::find((int) $request->route('id'));
        $projectExp = ProjectExpenses::where('project_id',(int) $request->route('id'))->get();
        return view('pages.project management.expenses.index',['projects'=>$project],['projectExp'=> $projectExp]);
    }
    public function projectsExp(){
        $projectExp=ProjectExpenses::all();
        return response()->json([
            'data'=>$projectExp,
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
            'floor'         => 'required',
            'apartment'     => 'required',
            'bedroom'       => 'required',
            'bathroom'      => 'required',
            'toilet'        => 'required',
            'kitchen'       => 'required',
            'salon'         => 'required',
        ],[
            'floor.required'     => 'شماره طبقه را وارد کنید',
            'apartment.required' => 'شماره واحد را وارد کنید',
            'bedroom.required'   => 'تعداد اطاق خواب را وارد کنید',
            'bathroom.required'  => 'تعداد حمام را وارد کنید',
            'toilet.required'    => 'تعداد تشناب را وارد کنید',
            'kitchen.required'   => 'تعداد آشپرخانه را وارد کنید',
            'salon.required'     => 'تعداد صالون را وارد کنید',
        ]);
        if ($validation->passes()) {
            $projectExp =[
            'project_id'  => $request->input('projectExp_id'),
            'floor'       => $request->input('floor'),
            'apartment'   => $request->input('apartment'),
            'bedroom'     => $request->input('bedroom'),
            'bathroom'    => $request->input('bathroom'),
            'toilet'      => $request->input('toilet'),
            'kitchen'     => $request->input('kitchen'),
            'salon'       => $request->input('salon'),
            ];
            $inserted=ProjectExpenses::create($projectExp);
            if ($inserted) {
                return response()->json(['success'=>'مشخصات واحد موفقانه اضافه شد ']);
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
        $projectExp=ProjectExpenses::find($id);
        return response()->json([
            'expenses'=>$projectExp,
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
            'floor'         => 'required',
            'apartment'     => 'required',
            'bedroom'       => 'required',
            'bathroom'      => 'required',
            'toilet'        => 'required',
            'kitchen'       => 'required',
            'salon'         => 'required',
        ],[
            'floor.required'     => 'شماره طبقه را وارد کنید',
            'apartment.required' => 'شماره واحد را وارد کنید',
            'bedroom.required'   => 'تعداد اطاق خواب را وارد کنید',
            'bathroom.required'  => 'تعداد حمام را وارد کنید',
            'toilet.required'    => 'تعداد تشناب را وارد کنید',
            'kitchen.required'   => 'تعداد آشپرخانه را وارد کنید',
            'salon.required'     => 'تعداد صالون را وارد کنید',
        ]);
        if ($validation->passes()) {
            $updated = ProjectExpenses::where('id',$request->input('edit_projectExp_id'))->update([
            'project_id'  => $request->input('projectExp_id'),
            'floor'       => $request->input('floor'),
            'apartment'   => $request->input('apartment'),
            'bedroom'     => $request->input('bedroom'),
            'bathroom'    => $request->input('bathroom'),
            'toilet'      => $request->input('toilet'),
            'kitchen'     => $request->input('kitchen'),
            'salon'       => $request->input('salon'),
            ]);
            if ($updated) {
                return response()->json(['success'=>'تغییرات موفقانه اعمال شد ']);
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
        ProjectExpenses::find($id)->delete();
    }
}
