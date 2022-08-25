<?php

namespace App\Http\Controllers;

use App\Models\BranchInfo;
use App\Models\Commercial_name;
use App\Models\Shipment;
use App\Models\Shipment_status;
use App\Setting;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Models\Print_report;
class PrintController extends Controller
{
    public function operationPrint(Request $request)
    {
        //return $request;
        $user = auth()->user();
        if (!$user->isAbleTo('index-shipment')) {
            return abort(403);
        }
        $brach_filter = request()->brach_filter;
        if (is_numeric($brach_filter)){
            $brach_filter = BranchInfo::where('serial_',request()->brach_filter)->first()->name_;
        }
        if(isset(request()->codes) || isset(request()->report))
        {
            if(isset(request()->report)){
                $report = request()->report;
                $report = Print_report::where('id',$report)->first();
                $codes= explode(',',$report->codes);
            }
            else
                $codes= explode(',',request()->codes);
            if (request()->type != 'fro3'){
            $all=Shipment::whereIn('code_',$codes);
            }
            if(request()->type == 'fro3' ){
                if( $brach_filter != '')
                {

                    $all=Shipment::whereIn('code_',$codes)->select('*',DB::raw("(CASE
                    WHEN ( branch_ = '{$user->branch}' and  transfere_1 = '{$brach_filter}' ) THEN  transfer_coast_1
                    WHEN ( transfere_1 = '{$user->branch}' and  transfere_2 = '{$brach_filter}' ) THEN transfer_coast_2
                    END) AS t7weel_cost"));
                                    


                }
                else
                {
                    $all=Shipment::whereIn('code_',$codes)->select('*',DB::raw("(CASE
                                    WHEN ( branch_ = '{$user->branch}' and  transfere_1 !=  '' ) THEN  transfer_coast_1
                                    WHEN ( transfere_1 = '{$user->branch}' and  transfere_2 != '' ) THEN transfer_coast_2
                                    END) AS t7weel_cost"));



                }
                //dd($all->get());
            }
            if(request()->type == 'import' ){
                if( $brach_filter != '')
                {

                    $all=Shipment::whereIn('code_',$codes)->select('*',DB::raw("(CASE
                    WHEN ( branch_ = '{$brach_filter }' and  transfere_1 = '{$user->branch}' and elfar3_elmosadad_mno = '') THEN  transfer_coast_1
                    WHEN ( transfere_1 = '{$brach_filter }' and  transfere_2 = '{$user->branch}' and elfar3_elmosadad_mno_2 = '') THEN transfer_coast_2
                    END) AS t7weel_cost"));


                }
                else
                {
                    $all=Shipment::whereIn('code_',$codes)->select('*',DB::raw("(CASE
                    WHEN ( branch_ != '' and  transfere_1 =  '{$user->branch}' and elfar3_elmosadad_mno = '') THEN  transfer_coast_1
                    WHEN ( transfere_1 != '' and  transfere_2 = '{$user->branch}' and elfar3_elmosadad_mno_2 = '') THEN transfer_coast_2
                    END) AS t7weel_cost"));
                                    



                }
            }
        }

        $all=$all->get();
        $totalCost = $all->sum('shipment_coast_');
        $tawsilCost = $all->sum('tawsil_coast_');
        $alSafiCost = $all->sum('total_');
        $printPage='shipments.print';
        $page_title = request()->title;
        
        //$brach_filter = request()->brach_filter;
        // fro3   shipment   3amel  mandoub
        if(request()->type == 'fro3' ){
            $printPage='frou3.accounting.print';
            //return $all;

            $ta7weel=0;
            foreach($all as $ship){
                $ta7weel += $ship->t7weel_cost ;
                
            }
            // dd($alSafiCost);
            $tawsilCost = $ta7weel;
            $alSafiCost = $totalCost - $tawsilCost;
            //dd($alSafiCost);
         
        }
        elseif(request()->type == 'import' ){
            $printPage='frou3.accounting.print';
            //return $all;

            $ta7weel=0;
            foreach($all as $ship){
                $ta7weel += $ship->t7weel_cost ;
                
            }
            // dd($alSafiCost);
            $tawsilCost = $ta7weel;
            $alSafiCost = $totalCost - $tawsilCost;
            //dd($alSafiCost);
         
        }elseif (request()->type == 'shipment'){
            $printPage='shipments.print';

        }elseif (request()->type == '3amel'){
            $printPage='accounting.3amil.print';
        }elseif (request()->type == 'mandoub_estlam'){
            $printPage='accounting.mandoubestlam.print';
            $alSafiCost = $totalCost - $tawsilCost;

        }elseif (request()->type == 'mandoub_taslim'){
            $tawsilCost = $all->sum('tas3ir_mandoub_taslim');
            $printPage='accounting.mandoubtaslim.print';
            $alSafiCost = $totalCost - $tawsilCost;
          
        }



        $sums=['totalCost' =>$totalCost, 'tawsilCost' =>$tawsilCost , 'alSafiCost'=>$alSafiCost,'company'=>1];


        $data = [
            'all'=>$all,
            'title'=>$page_title,
            'sum'=>$sums
        ];
      
        $mpdf = PDF::loadView($printPage,$data);
        $mpdf->showImageErrors = true;
        return $mpdf->stream('document.pdf');



    }


    public function reportPrint(){

        $report = request()->report;
        $report = Print_report::where('id',$report)->first();
        dd($report);
    }

    public function save_report(Request $request){
        if(isset(request()->codes))
        {
            $user=auth()->user();
            $codes= implode(',',request()->codes);
            if(request()->save ==1){ 
                $report = new Print_report();
                $report->codes = $codes;
                $report->user_id = $user->code_;
                $report->save();
                return response()->json([
                    'status' => 200,
                    'id' => $report->id,
                    'message' => 'تم الحفظ',
                ], 200);
            }
        }
    }

}
