<?php

namespace App\Http\Controllers;

use App\Models\projectConstruction;
use Illuminate\Support\Facades\Redirect;
use App\Models\ProjectExpenses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\ProjectFactory;


class ProjExpenseReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $projExpReport=projectConstruction::get();
        return view('pages.project management.ExpensesReport.index');
    }
    
    public function projectsExpReport(Request $request){
        if($request->filled('start_date') || $request->filled('end_date'))
        {
            $validation= Validator::make($request->all(),[
                'start_date'    => 'required',
                'end_date'      => 'required',
            ]);
            if ($validation->passes()) {
                $projExpReport  = projectConstruction::wherebetween('created_at', [$request->input('start_date'), $request->input('end_date')])->get();
                return response()->json([
                    'data'=>$projExpReport,
                    'success'=>'جستجو انجام شد',
                ]);
            }
            else{
                return response() -> json (['error' => $validation->errors()->all()]);
            }
        }
        else {
            $projExpReport2=projectConstruction::get();
            return response()->json([
                'data'=>$projExpReport2,
            ]);
        }
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
        // $validation= Validator::make($request->all(),[
        //     'start_date'    => 'required',
        //     'end_date'      => 'required',
        // ]);
        // if ($validation->passes()) {
        //     $projExpReport  = projectConstruction::wherebetween('created_at', [$request->input('start_date'), $request->input('end_date')])->get();
        //     return view('pages.project management.ExpensesReport.index',['projExpReport'=> $projExpReport]);
        // }
        // else{
        //     return response() -> json (['error' => $validation->errors()->all()]);
        // }
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
        //
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
        //
    }
}
