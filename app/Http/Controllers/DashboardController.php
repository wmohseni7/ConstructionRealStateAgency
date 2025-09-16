<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\AltClaims;
use App\Models\AltDebts;
use App\Models\Project;
use App\Models\ProjectExpenses;
use App\Models\Properties;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Project::Select(\DB::raw("COUNT(*) as count"))
                    ->whereYear('created_at', date('Y')) /* for Current Year =>  date('Y') */
                    ->groupBy(\DB::raw("Month(created_at)"))
                    ->pluck('count');
        // $chart_options=[
        //     'chart_title'    => 'projects by weeks' ,
        //     'report_type'    => 'group_by_date',
        //     'model'          => 'App\Models\Projects',
        //     'group_by_field' => 'created_at',
        //     'group_by_period'=> 'week',
        //     'chart_type'     => 'line',
        // ];

        // $chart1 = new LaravelChart($chart_options);

        $agency           = Agency::get()->count();
        $projects         = Project::get()->count();
        $ongoing_projects = ProjectExpenses::get()->count();
        $properties       = Properties::get()->count();
        $debts            = AltDebts::get()->count();
        $claims           = AltClaims::get()->count();
        // $projects=
        // DB::table('projects')
        // ->where('projects.created_at','>', \DB::raw('NOW() - INTERVAL 30 DAY'))
        // ->count('projects.id');

        // $projects_income=
        // DB::table('projects')
        // ->where('projects.created_at','>', \DB::raw('NOW() - INTERVAL 30 DAY'))
        // ->sum('paid');
        

        
        // /* Begin:: Extra Income Chart */
        //     $total_expense = DB::table('projects')
        //         ->where('date','like',ymd('y').'-__%' )
        //         ->select(DB::raw('sum(paid) as total') ,DB::raw("DATE_FORMAT(date ,'%Y-%m') new_date"))
        //         ->groupBy('new_date')
        //         ->get();

        //     $hamalExpense  =0;
        //     $sawrExpense   =0;
        //     $jawzaExpense  =0;
        //     $sartanExpense =0;
        //     $asadExpense   =0;
        //     $subulaExpense =0;
        //     $mezanExpense  =0;
        //     $aqrabExpense  =0;
        //     $qusExpense    =0;
        //     $jadiExpense   =0;
        //     $dalvExpense   =0;
        //     $hootExpense   =0;

        //     foreach ($total_expense as $exp) {
        //         switch ($exp->new_date) {
        //             case ymd('y').'-01':
        //                 $hamalExpense = $exp->total;
        //                 break;
        //             case ymd('y').'-02':
        //                 $sawrExpense = $exp->total;
        //                 break;
        //             case ymd('y').'-03':
        //                 $jawzaExpense = $exp->total;
        //                 break;
        //             case ymd('y').'-04':
        //                 $sartanExpense = $exp->total;
        //                 break;
        //             case ymd('y').'-05':
        //                 $asadExpense = $exp->total;
        //                 break;
        //             case ymd('y').'-06':
        //                 $subulaExpense = $exp->total;
        //                 break;
        //             case ymd('y').'-07':
        //                 $mezanExpense = $exp->total;
        //                 break;
        //             case ymd('y').'-08':
        //                 $aqrabExpense= $exp->total;
        //                 break;
        //             case ymd('y').'-09':
        //                 $qusExpense= $exp->total;
        //                 break;
        //             case ymd('y').'-10':
        //                 $jadiExpense = $exp->total;
        //                 break;
        //             case ymd('y').'-11':
        //                 $dalvExpense = $exp->total;
        //                 break;
        //             case ymd('y').'-12':
        //                 $hootExpense = $exp->total;
        //                 break;
                    
        //             default:
        //                 dd('ok');
        //                 break;
        //         }
        //     }
        /* End:: Extra Income Chart */
        // dd($hamalExpense . '-'.$sawrExpense . '-'  . '-'.$jawzaExpense . '-'.$sartanExpense . '-'. $asadExpense .'-'.$subulaExpense . '-' . $mezanExpense . '-' .$aqrabExpense.'-'.$qusExpense);
        return view('pages.dashboard.index',compact('users'))->with(['projects'=>$projects])->with(['agency'=>$agency])->with(['ongoing'=>$ongoing_projects])->with(['properties'=>$properties])->with(['AltDebts'=>$debts])->with(['AltClaims'=>$claims]);
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
        //
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
