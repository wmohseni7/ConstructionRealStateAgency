<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Charts;
include 'PersianCalendar.php';
use App\Models\Project;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

        // $users = 
        // DB::table('users')
        // ->count('users.id');

        // $orders = 
        // DB::table('orders')
        // ->where('orders.order_status', "2")
        // ->where('orders.created_at', '>', \DB::raw('NOW() - INTERVAL 24 HOUR'))
        // ->count('orders.id');

        // $ordersIncome = 
        // DB::table('payments')
        // ->where('payments.created_at', '>', \DB::raw('NOW() - INTERVAL 24 HOUR'))
        // ->sum('paid');
        
        // $extraIncome =
        // DB::table('extra_incomes')
        // ->where('extra_incomes.created_at', '>', \DB::raw('NOW() - INTERVAL 24 HOUR'))
        // ->sum('cash_amount');

        // $extraExpense =
        // DB::table('extra_expenses')
        // ->where('extra_expenses.created_at', '>', \DB::raw('NOW() - INTERVAL 24 HOUR'))
        // ->sum('cash_amount');

        // $projects=
        // DB::table('projects')
        // ->where('projects.created_at','>', \DB::raw('NOW() - INTERVAL 30 DAY'))
        // ->count('projects.id');

        // $projects_income=
        // DB::table('projects')
        // ->where('projects.created_at','>', \DB::raw('NOW() - INTERVAL 30 DAY'))
        // ->sum('paid');
        

        
        /* Begin:: Extra Income Chart */
            // $total_expense = DB::table('projects')
            //     ->where('date','like',ymd('y').'-__%' )
            //     ->select(DB::raw('sum(paid) as total') ,DB::raw("DATE_FORMAT(date ,'%Y-%m') new_date"))
            //     ->groupBy('new_date')
            //     ->get();

            // $hamalExpense  =0;
            // $sawrExpense   =0;
            // $jawzaExpense  =0;
            // $sartanExpense =0;
            // $asadExpense   =0;
            // $subulaExpense =0;
            // $mezanExpense  =0;
            // $aqrabExpense  =0;
            // $qusExpense    =0;
            // $jadiExpense   =0;
            // $dalvExpense   =0;
            // $hootExpense   =0;

            // foreach ($total_expense as $exp) {
            //     switch ($exp->new_date) {
            //         case ymd('y').'-01':
            //             $hamalExpense = $exp->total;
            //             break;
            //         case ymd('y').'-02':
            //             $sawrExpense = $exp->total;
            //             break;
            //         case ymd('y').'-03':
            //             $jawzaExpense = $exp->total;
            //             break;
            //         case ymd('y').'-04':
            //             $sartanExpense = $exp->total;
            //             break;
            //         case ymd('y').'-05':
            //             $asadExpense = $exp->total;
            //             break;
            //         case ymd('y').'-06':
            //             $subulaExpense = $exp->total;
            //             break;
            //         case ymd('y').'-07':
            //             $mezanExpense = $exp->total;
            //             break;
            //         case ymd('y').'-08':
            //             $aqrabExpense= $exp->total;
            //             break;
            //         case ymd('y').'-09':
            //             $qusExpense= $exp->total;
            //             break;
            //         case ymd('y').'-10':
            //             $jadiExpense = $exp->total;
            //             break;
            //         case ymd('y').'-11':
            //             $dalvExpense = $exp->total;
            //             break;
            //         case ymd('y').'-12':
            //             $hootExpense = $exp->total;
            //             break;
                    
            //         default:
            //             dd('ok');
            //             break;
            //     }
            // }
        /* End:: Extra Income Chart */

        /* Begin:: Extra Expense Chart */
            // $total_expense2 = DB::table('extra_expenses')
            // ->where('date','like',ymd('y').'-__%' )
            // ->select(DB::raw('sum(cash_amount) as total') ,DB::raw("DATE_FORMAT(date ,'%Y-%m') new_date"))
            // ->groupBy('new_date')
            // ->get();

            // $hamalExpense2  =0;
            // $sawrExpense2   =0;
            // $jawzaExpense2  =0;
            // $sartanExpense2 =0;
            // $asadExpense2   =0;
            // $subulaExpense2 =0;
            // $mezanExpense2  =0;
            // $aqrabExpense2  =0;
            // $qusExpense2    =0;
            // $jadiExpense2   =0;
            // $dalvExpense2   =0;
            // $hootExpense2   =0;

            // foreach ($total_expense2 as $exp) {
            //     switch ($exp->new_date) {
            //         case ymd('y').'-01':
            //             $hamalExpense2 = $exp->total;
            //             break;
            //         case ymd('y').'-02':
            //             $sawrExpense2 = $exp->total;
            //             break;
            //         case ymd('y').'-03':
            //             $jawzaExpense2 = $exp->total;
            //             break;
            //         case ymd('y').'-04':
            //             $sartanExpense2 = $exp->total;
            //             break;
            //         case ymd('y').'-05':
            //             $asadExpense2 = $exp->total;
            //             break;
            //         case ymd('y').'-06':
            //             $subulaExpense2 = $exp->total;
            //             break;
            //         case ymd('y').'-07':
            //             $mezanExpense2 = $exp->total;
            //             break;
            //         case ymd('y').'-08':
            //             $aqrabExpense2= $exp->total;
            //             break;
            //         case ymd('y').'-09':
            //             $qusExpense2= $exp->total;
            //             break;
            //         case ymd('y').'-10':
            //             $jadiExpense2 = $exp->total;
            //             break;
            //         case ymd('y').'-11':
            //             $dalvExpense2 = $exp->total;
            //             break;
            //         case ymd('y').'-12':
            //             $hootExpense2 = $exp->total;
            //             break;
                    
            //         default:
            //             dd('ok');
            //             break;
            //     }
            // }
        /* End:: Extra Expense Chart */

        /* Begin:: Total of Purchased Products Expense Chart */
            // $total_expense3 = DB::table('purchased_from')
            // ->where('date','like',ymd('y').'-__%' )
            // ->select(DB::raw('sum(total_price) as total') ,DB::raw("DATE_FORMAT(date ,'%Y-%m') new_date"))
            // ->groupBy('new_date')
            // ->get();

            // $hamalExpense3  =0;
            // $sawrExpense3   =0;
            // $jawzaExpense3  =0;
            // $sartanExpense3 =0;
            // $asadExpense3   =0;
            // $subulaExpense3 =0;
            // $mezanExpense3  =0;
            // $aqrabExpense3  =0;
            // $qusExpense3    =0;
            // $jadiExpense3   =0;
            // $dalvExpense3   =0;
            // $hootExpense3   =0;

            // foreach ($total_expense3 as $exp) {
            //     switch ($exp->new_date) {
            //         case ymd('y').'-01':
            //             $hamalExpense3 = $exp->total;
            //             break;
            //         case ymd('y').'-02':
            //             $sawrExpense3 = $exp->total;
            //             break;
            //         case ymd('y').'-03':
            //             $jawzaExpense3 = $exp->total;
            //             break;
            //         case ymd('y').'-04':
            //             $sartanExpense3 = $exp->total;
            //             break;
            //         case ymd('y').'-05':
            //             $asadExpense3 = $exp->total;
            //             break;
            //         case ymd('y').'-06':
            //             $subulaExpense3 = $exp->total;
            //             break;
            //         case ymd('y').'-07':
            //             $mezanExpense3 = $exp->total;
            //             break;
            //         case ymd('y').'-08':
            //             $aqrabExpense3= $exp->total;
            //             break;
            //         case ymd('y').'-09':
            //             $qusExpense3= $exp->total;
            //             break;
            //         case ymd('y').'-10':
            //             $jadiExpense3 = $exp->total;
            //             break;
            //         case ymd('y').'-11':
            //             $dalvExpense3 = $exp->total;
            //             break;
            //         case ymd('y').'-12':
            //             $hootExpense3 = $exp->total;
            //             break;
                    
            //         default:
            //             dd('ok');
            //             break;
            //     }
            // }
        /* End:: Total of Purchased Products Expense Chart */
 
        /* Begin:: Extra Expense Chart */
            // $total_expense4 = DB::table('payments')
            // ->where('date','like',ymd('y').'-__%' )
            // ->select(DB::raw('sum(total) as total') ,DB::raw("DATE_FORMAT(date ,'%Y-%m') new_date"))
            // ->groupBy('new_date')
            // ->get();

            // $hamalExpense4  =0;
            // $sawrExpense4   =0;
            // $jawzaExpense4  =0;
            // $sartanExpense4 =0;
            // $asadExpense4   =0;
            // $subulaExpense4 =0;
            // $mezanExpense4  =0;
            // $aqrabExpense4  =0;
            // $qusExpense4    =0;
            // $jadiExpense4   =0;
            // $dalvExpense4   =0;
            // $hootExpense4   =0;

            // foreach ($total_expense4 as $exp) {
            //     switch ($exp->new_date) {
            //         case ymd('y').'-01':
            //             $hamalExpense4 = $exp->total;
            //             break;
            //         case ymd('y').'-02':
            //             $sawrExpense4 = $exp->total;
            //             break;
            //         case ymd('y').'-03':
            //             $jawzaExpense4 = $exp->total;
            //             break;
            //         case ymd('y').'-04':
            //             $sartanExpense4 = $exp->total;
            //             break;
            //         case ymd('y').'-05':
            //             $asadExpense4 = $exp->total;
            //             break;
            //         case ymd('y').'-06':
            //             $subulaExpense4 = $exp->total;
            //             break;
            //         case ymd('y').'-07':
            //             $mezanExpense4 = $exp->total;
            //             break;
            //         case ymd('y').'-08':
            //             $aqrabExpense4= $exp->total;
            //             break;
            //         case ymd('y').'-09':
            //             $qusExpense4= $exp->total;
            //             break;
            //         case ymd('y').'-10':
            //             $jadiExpense4 = $exp->total;
            //             break;
            //         case ymd('y').'-11':
            //             $dalvExpense4 = $exp->total;
            //             break;
            //         case ymd('y').'-12':
            //             $hootExpense4 = $exp->total;
            //             break;
                    
            //         default:
            //             dd('ok');
            //             break;
            //     }
            // }
    /* End:: Extra Expense Chart */


        // dd($hamalExpense . '-'.$sawrExpense . '-'  . '-'.$jawzaExpense . '-'.$sartanExpense . '-'. $asadExpense .'-'.$subulaExpense . '-' . $mezanExpense . '-' .$aqrabExpense.'-'.$qusExpense);
        return view('pages.dashboard.index' , compact(
            'users'         ,'projects',
            'hamalExpense'  , 'sawrExpense'  , 'jawzaExpense'  ,'sartanExpense' , 'asadExpense' , 'subulaExpense' , 'mezanExpense' , 'aqrabExpense' , 'qusExpense' , 'jadiExpense' , 'dalvExpense' , 'hootExpense' ,
            )
        );
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
