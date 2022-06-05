<?php

namespace App\Http\Controllers;

use App\CustomClass\response;
use App\Http\Controllers\Api\site\Controller;
use App\Models\BranchInfo;
use App\Models\Mantikqa;
use App\Models\Mohfza;
use App\Models\Shipment;
use App\Models\Tempo;
use App\Models\AllUser;
use App\Models\Shipment_status;
use App\Models\Commercial_name;
use App\Models\Archive;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class frou3Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function export(){
        
            $user=auth()->user();
            $offset=0; $limit=10;
            if(isset(request()->offset ))   $offset =request()->offset;
            if(isset(request()->limit ))   $limit =request()->limit;
            
            $shipments_null_date = Shipment::with(['Branch_user' => function ($query) {
                $query->select('code_','phone_');
            },
            'Shipment_status'=> function ($query) {
                $query->select('code_','name_');
            },])
            
            ->UserType($user->type_,$user->code_)
            ->where('tarikh_tasdid_el3amil' ,'')
            ->where('tarikh_el7ala' ,'');
            if(isset(request()->commercial_name)){
                $shipments_null_date = $shipments_null_date->where('add_shipment_tb_.commercial_name_', request()->commercial_name);
            }

            $shipments = Shipment::with(['Branch_user' => function ($query) {
                $query->select('code_','phone_');
            }]);
            
           
            
            if($user->type_== 'مندوب استلام' && $status ==3){
                $shipments = $shipments->where('branch_',$user->branch);
                
            }else{
                $shipments = $shipments->UserType($user->type_,$user->code_);
            }
            if(isset(request()->commercial_name)){
                $shipments = $shipments->where('add_shipment_tb_.commercial_name_', request()->commercial_name);
            }

           
            $all_shipments = $shipments;

            if($user->type_ =='عميل'){
               
                if(isset( request()->date_from))
                    $all_shipments= $all_shipments->where('date_' ,'>=',DATE($request->date_from) );
                if(isset( request()->date_to))
                    $all_shipments= $all_shipments->where('date_' ,'<=' ,DATE($request->date_to) );
                   
            }else{
                if(isset( request()->date_from))
                    $all_shipments= $all_shipments->where('tarikh_el7ala' ,'>=',DATE( request()->date_from) );
                if(isset( request()->date_to))
                    $all_shipments= $all_shipments->where('tarikh_el7ala' ,'<=',DATE( request()->date_to) );

            }
            

            $counter= $all_shipments->get();
            
            $totalCost = $counter->sum('shipment_coast_');
            if($user->type_=='عميل')
                $tawsilCost = $counter->sum('tawsil_coast_');
            if($user->type_=='مندوب استلام')
                $tawsilCost = $counter->sum('tas3ir_mandoub_estlam');
            if($user->type_=='مندوب تسليم')
                $tawsilCost = $counter->sum('tas3ir_mandoub_taslim');
            
            $netCost =  $totalCost-$tawsilCost;

            $count_all = $counter->count();
            if(request()->page == -100)
                request()->limit=$count_all;
            $all = $all_shipments->paginate(request()->limit ?? 10);
       return  view('frou3.export' ,compact('all'));
    }
    public function import(){
        return  view('frou3.import');
    }
    //t7wel sho7nat
    public function frou3_t7wel_sho7nat_manual(){
        
    }
    public function frou3_t7wel_sho7nat_manual_save(Request $request){
        
    }
    public function frou3_t7wel_sho7nat_qr(Request $request){
        $branches=DB::table('branch_info_tb')
        ->select('serial_','name_')
        ->get();
        return view('frou3.t7wel_sho7nat.qr',compact('branches'));
    }
    public function frou3_t7wel_sho7nat_qr_save(Request $request){
        $status=array(1);

        $branch=DB::table('branch_info_tb')
        ->where('serial_',$request->status)
        ->select('serial_','name_')->first();
        $user = $user = auth()->user();        

        $t1 =DB::table('add_shipment_tb_')
            ->whereIn('add_shipment_tb_.code_', $request->code)
            ->where('add_shipment_tb_.transfere_1', '')
            ->where('add_shipment_tb_.status_', 1)
            ->where('add_shipment_tb_.branch_', $user->branch)->get();
        Tempo::insert(json_decode(json_encode($t1), true));
            
        $t2 = DB::table('add_shipment_tb_')
            ->whereIn('add_shipment_tb_.code_', $request->code)
            ->where('add_shipment_tb_.transfere_1','!=', '')
            ->where('add_shipment_tb_.status_', 1)->get();
        Tempo::insert(json_decode(json_encode($t2), true));

         $q1 =DB::table('add_shipment_tb_')
         ->whereIn('add_shipment_tb_.code_', $request->code)
         ->where('add_shipment_tb_.transfere_1', '')
         ->where('add_shipment_tb_.status_', 1)
         ->where('transfer_prices_main_tb.branch', $user->branch)
        ->join('transfer_prices_main_tb', function($join){
            $join->on('transfer_prices_main_tb.mantika_id', '=', 'add_shipment_tb_.mantika_id');
            $join->on('transfer_prices_main_tb.mo7afaza_id','=','add_shipment_tb_.mo7afaza_id'); 
         });

            $q2 = DB::table('add_shipment_tb_')
            ->whereIn('add_shipment_tb_.code_', $request->code)
            ->where('add_shipment_tb_.transfere_1','!=', '')
            ->where('add_shipment_tb_.status_', 1)
            ->where('transfer_prices_main_tb.branch', $user->branch)
           ->join('transfer_prices_main_tb', function($join){
               $join->on('transfer_prices_main_tb.mantika_id', '=', 'add_shipment_tb_.mantika_id');
               $join->on('transfer_prices_main_tb.mo7afaza_id','=','add_shipment_tb_.mo7afaza_id'); 
            });
            $q2 =  $q2->update(['add_shipment_tb_.transfere_2'=>$branch->name_,
            'add_shipment_tb_.transfer_coast_2' =>DB::raw("`transfer_prices_main_tb`.`price_`"),
            'TRANSFERE_ACCEPT_REFUSE'=>2,
            'tarikh_el7ala'=>Carbon::now()->format('Y-m-d'),
            'Ship_area_'=>$branch->name_
            ]);

            
           

            $q1=$q1->update(['add_shipment_tb_.transfere_1'=>$branch->name_,
            'add_shipment_tb_.transfer_coast_1' =>DB::raw("`transfer_prices_main_tb`.`price_`") ,
            'TRANSFERE_ACCEPT_REFUSE'=>2,
            'tarikh_el7ala'=>Carbon::now()->format('Y-m-d'),
            'Ship_area_'=>$branch->name_]);
   
            

        

              return response()->json([
                'status' => 200,
                'message' => 'تم التحويل',
            ], 200);      
        }

    
    
    public function accept_frou3_t7wel(Request $request)
    { 
        
         $user=auth()->user();
         $offset=0; $limit=10;
         if(isset(request()->offset ))   $offset =request()->offset;
         if(isset(request()->limit ))   $limit =request()->limit;
         
     

         $shipments = Shipment::with(['Branch_user' => function ($query) {
             $query->select('code_','phone_');
         }])
         ->where('Ship_area_', '=', $user->branch)
         ->where('TRANSFERE_ACCEPT_REFUSE',2);
         
        
    
         if(isset($request->branch)){
             $shipments = $shipments->where(function ($query) use($request){
                $query->where('branch_', '=', $request->branch)
                      ->orWhere('transfere_1', '=', $request->branch);
            });        
         }
         if(isset($request->mo7afza)){
            $shipments = $shipments->where('mo7afaza_id', '=', $request->mo7afza);       
        }

         $all_shipments = $shipments;

         if($user->type_ =='عميل'){
            
             if(isset( request()->date_from))
                 $all_shipments= $all_shipments->where('date_' ,'>=',DATE($request->date_from) );
             if(isset( request()->date_to))
                 $all_shipments= $all_shipments->where('date_' ,'<=' ,DATE($request->date_to) );
                
         }else{
             if(isset( request()->date_from))
                 $all_shipments= $all_shipments->where('tarikh_el7ala' ,'>=',DATE( request()->date_from) );
             if(isset( request()->date_to))
                 $all_shipments= $all_shipments->where('tarikh_el7ala' ,'<=',DATE( request()->date_to) );

         }
         
         $counter= $all_shipments->get();
         
         $totalCost = $counter->sum('shipment_coast_');
         if($user->type_=='عميل')
             $tawsilCost = $counter->sum('tawsil_coast_');
         if($user->type_=='مندوب استلام')
             $tawsilCost = $counter->sum('tas3ir_mandoub_estlam');
         if($user->type_=='مندوب تسليم')
             $tawsilCost = $counter->sum('tas3ir_mandoub_taslim');
         
         $netCost =  $totalCost-$tawsilCost;

         $count_all = $counter->count();
         if(request()->showAll == 'on')
             request()->limit=$count_all;
         $all = $all_shipments->paginate(request()->limit ?? 10);
         
         $all->withPath("?limit={$request->limit}&branch={$request->branch}&mo7afza={$request->mo7afza}&showAll={$request->showAll}");
        // $data=$all->items();
       $branches =BranchInfo::all();
       $mo7afazat =Mohfza::all();
         return view('frou3.t7wel_sho7nat.accept',compact('all','branches','mo7afazat'));
    
    }
    public function accept_frou3_t7wel_save(Request $request){
        $user=auth()->user();
        $t2 = Tempo::where('code_', $request->code)
        ->first();

        $shipment=Shipment::where('code_',$request->code)
        ->where('TRANSFERE_ACCEPT_REFUSE',2)
        ->where('Ship_area_', '=', $user->branch);
                  
   
        if($request->type=='accept'){
            
            $shipment=$shipment->first();
            if(!isset($shipment)) return ;
            $shipment->TRANSFERE_ACCEPT_REFUSE =1;
            $shipment->save();
        }
        elseif($request->type=='cancel'){
            if(isset($t2))
            Shipment::insert(json_decode(json_encode($t2), true));
            else{
                return response()->json([
                    'status' => 404,
                ], 404);
            }
            $shipment->first()->delete();
        }
        if(isset($t2))
         $t2->delete();
    }
    public function accept_frou3_t7wel_qr_save(Request $request){
       // dd($request->all());
        $user = auth()->user();
        DB::table('add_shipment_tb_')
        ->whereIN('code_',$request->code)
        ->where('TRANSFERE_ACCEPT_REFUSE',2)
        ->where('Ship_area_', '=', $user->branch)
        ->update([
            'TRANSFERE_ACCEPT_REFUSE' =>1,

        ]);

        DB::table('add_shipment_tempo')
        ->whereIN('code_',$request->code)
        ->delete();
        return response()->json([
            'status' => 200,
            'message' => 'تم الموافقة',
        ], 200);  

    }
    public function accept_t7wel_get(Request $request)
    {
        $user = auth()->user();
        $shipment =Shipment::where('code_',$request->code)
        ->where('Ship_area_', '=', $user->branch)
        ->where('TRANSFERE_ACCEPT_REFUSE',2);
        $shipment= $shipment->with(['Shipment_status'])
        ->get(); 
       
        if($shipment->count()== 1)
        {
            $status=200;
            $data=$shipment;
        }
        else
        {
            $status=404;
            $data=[];
        }
        return response()->json([
            'status' => $status,
            'data' => $data,
        ], $status);
    }
    //end t7weel sho7nat

    //rag3
    public function frou3_t7wel_rag3_qr(Request $request){
        $branches=DB::table('branch_info_tb')
        ->select('serial_','name_')
        ->get();
        return view('frou3.t7wel_rag3.qr',compact('branches'));
    }
    public function frou3_t7wel_rag3_qr_save(Request $request){
        $status=array(1);

        $branch=DB::table('branch_info_tb')
        ->where('serial_',$request->status)
        ->select('serial_','name_')->first();
      
        $user = $user = auth()->user();
        //993
     
            $t1 =DB::table('add_shipment_tb_')
            ->whereIn('add_shipment_tb_.code_', $request->code)
            ->where('add_shipment_tb_.transfere_2' ,'')
            ->where('add_shipment_tb_.transfere_1' ,'!=','')
            ->where('add_shipment_tb_.status_', 9)
            ->where('add_shipment_tb_.branch_', $user->branch)->get();
            Tempo::insert(json_decode(json_encode($t1), true));

            $t2 = DB::table('add_shipment_tb_')
            ->whereIn('add_shipment_tb_.code_', $request->code)
            ->where('add_shipment_tb_.transfere_2','!=' ,'')
            ->where('add_shipment_tb_.status_', 9)
            ->where('add_shipment_tb_.branch_', $user->branch)->get();
            Tempo::insert(json_decode(json_encode($t2), true));

            DB::table('add_shipment_tb_')
            ->whereIn('add_shipment_tb_.code_', $request->code)
            ->where('add_shipment_tb_.transfere_2' ,'')
            ->where('add_shipment_tb_.transfere_1' ,'!=','')
            ->where('add_shipment_tb_.status_', 9)
            ->where('add_shipment_tb_.branch_', $user->branch)
           ->join('transfer_prices_main_tb', function($join){
               $join->on('transfer_prices_main_tb.mantika_id', '=', 'add_shipment_tb_.mantika_id');
               $join->on('transfer_prices_main_tb.mo7afaza_id','=','add_shipment_tb_.mo7afaza_id'); 
            })
   
               ->update(['add_shipment_tb_.transfere_1'=>'',
                'add_shipment_tb_.transfer_coast_1' =>'',
                'add_shipment_tb_.TRANSFERE_ACCEPT_REFUSE'=>3,
                'tarikh_el7ala'=>Carbon::now()->format('Y-m-d'),
                'Ship_area_'=>$branch->name_ ]);

               DB::table('add_shipment_tb_')
               ->whereIn('add_shipment_tb_.code_', $request->code)
               ->where('add_shipment_tb_.transfere_2','!=' ,'')
               ->where('add_shipment_tb_.status_', 9)
               ->where('add_shipment_tb_.branch_', $user->branch)
              ->join('transfer_prices_main_tb', function($join){
                  $join->on('transfer_prices_main_tb.mantika_id', '=', 'add_shipment_tb_.mantika_id');
                  $join->on('transfer_prices_main_tb.mo7afaza_id','=','add_shipment_tb_.mo7afaza_id'); 
               })
      
                  ->update(['add_shipment_tb_.transfere_2'=>'', 
                  'add_shipment_tb_.transfer_coast_2' =>'',
                  'add_shipment_tb_.TRANSFERE_ACCEPT_REFUSE'=>3,
                  'tarikh_el7ala'=>Carbon::now()->format('Y-m-d'),
                  'Ship_area_'=>$branch->name_ ]);
                 
                  
        

              return response()->json([
                'status' => 200,
                'message' => 'تم التحويل',
            ], 200);      
        }


    public function accept_frou3_rag3(Request $request)
    { 
        
        $user=auth()->user();
        $offset=0; $limit=10;
        if(isset(request()->offset ))   $offset =request()->offset;
        if(isset(request()->limit ))   $limit =request()->limit;
        $shipments = Shipment::with(['Branch_user' => function ($query) {
            $query->select('code_','phone_');
        }])
        ->where('Ship_area_', '=', $user->branch)
        ->where('TRANSFERE_ACCEPT_REFUSE',3);

        if(isset($request->branch)){
            $shipments = $shipments->where(function ($query) use($request){
               $query->where('branch_', '=', $request->branch)
                     ->orWhere('transfere_1', '=', $request->branch);
           });        
        }
        if(isset($request->mo7afza)){
           $shipments = $shipments->where('mo7afaza_id', '=', $request->mo7afza);       
       }
        $all_shipments = $shipments;
        if($user->type_ =='عميل'){
            if(isset( request()->date_from))
                $all_shipments= $all_shipments->where('date_' ,'>=',DATE($request->date_from) );
            if(isset( request()->date_to))
                $all_shipments= $all_shipments->where('date_' ,'<=' ,DATE($request->date_to) );
        }else{
            if(isset( request()->date_from))
                $all_shipments= $all_shipments->where('tarikh_el7ala' ,'>=',DATE( request()->date_from) );
            if(isset( request()->date_to))
                $all_shipments= $all_shipments->where('tarikh_el7ala' ,'<=',DATE( request()->date_to) );
        }
        $counter= $all_shipments->get();
        $totalCost = $counter->sum('shipment_coast_');
        if($user->type_=='عميل')
            $tawsilCost = $counter->sum('tawsil_coast_');
        if($user->type_=='مندوب استلام')
            $tawsilCost = $counter->sum('tas3ir_mandoub_estlam');
        if($user->type_=='مندوب تسليم')
            $tawsilCost = $counter->sum('tas3ir_mandoub_taslim');
        
        $netCost =  $totalCost-$tawsilCost;

        $count_all = $counter->count();
        if(request()->showAll == 'on')
            request()->limit=$count_all;
        $all = $all_shipments->paginate(request()->limit ?? 10);
        
        $all->withPath("?limit={$request->limit}&branch={$request->branch}&mo7afza={$request->mo7afza}&showAll={$request->showAll}");
        $branches =BranchInfo::all();
        $mo7afazat =Mohfza::all();
        return view('frou3.t7wel_rag3.accept',compact('all','branches','mo7afazat'));
    }
    public function accept_frou3_rag3_save(Request $request){
        $user=auth()->user();
        
        $t2 = Tempo::where('code_', $request->code)
        ->first();
    
    
        $shipment=Shipment::where('code_',$request->code)
        ->where('TRANSFERE_ACCEPT_REFUSE',3)
        ->where('Ship_area_', '=', $user->branch);
                  
   
        if($request->type=='accept'){
            
            $shipment=$shipment->first();
            if(!isset($shipment)) return ;
            $shipment->TRANSFERE_ACCEPT_REFUSE =1;
            $shipment->save();
        }

        elseif($request->type=='cancel'){
            if(isset($t2))
                Shipment::insert(json_decode(json_encode($t2), true));
            else{
                return response()->json([
                    'status' => 404,
                ], 404);
            }
            $shipment->first()->delete();
        }
        if(isset($t2))
            $t2->delete();
    }
    public function accept_frou3_rag3_qr_save(Request $request){
      
         $user = auth()->user();
         DB::table('add_shipment_tb_')
         ->whereIN('code_',$request->code)
         ->where('TRANSFERE_ACCEPT_REFUSE',3)
         ->where('Ship_area_', '=', $user->branch)
         ->update([
             'TRANSFERE_ACCEPT_REFUSE' =>1,
 
         ]);
 
         DB::table('add_shipment_tempo')
         ->whereIN('code_',$request->code)
         ->delete();
         return response()->json([
             'status' => 200,
             'message' => 'تم الموافقة',
         ], 200);  
 
     }
    public function accept_rag3_get(Request $request)
     {
         $user = auth()->user();
         $shipment =Shipment::where('code_',$request->code)
         ->where('Ship_area_', '=', $user->branch)
         ->where('TRANSFERE_ACCEPT_REFUSE',3);
         $shipment= $shipment->with(['Shipment_status'])
         ->get(); 
        
         if($shipment->count()== 1)
         {
             $status=200;
             $data=$shipment;
         }
         else
         {
             $status=404;
             $data=[];
         }
         return response()->json([
             'status' => $status,
             'data' => $data,
         ], $status);
     }
    //end rag3




    //acc
    public function AccountingNotMosadad(Request $request)
    { 
        
        $user=auth()->user();
        $limit=10;
        $brach_filter = 'الفرع الرئيسى';
        if(isset($request->branch))
            $brach_filter= $request->branch;
        $waselOnly=0;
        if(isset($request->waselOnly))
            $waselOnly= 1;
            
        if(isset(request()->limit ))   $limit =request()->limit;
        $shipments = Shipment::select('*',DB::raw("(CASE 
                                    WHEN ( branch_ = '{$user->branch}' and  transfere_1 = '{$brach_filter}' and elfar3_elmosadad_mno = '') THEN  transfer_coast_1
                                    WHEN ( transfere_1 = '{$user->branch}' and  transfere_2 = '{$brach_filter}' and elfar3_elmosadad_mno_2 = '') THEN transfer_coast_2
                                    END) AS t7weel_cost"))
        ->where(function ($query) use($request,$user,$brach_filter){
            $query->where(function ($query) use($request,$user,$brach_filter){
                $query->where('branch_', '=', $user->branch)
                ->where('transfere_1', $brach_filter)
                ->where('elfar3_elmosadad_mno','');

                /*
                    get transfere_cost_1

                */
                })
                ->orWhere(function ($query) use($request,$user,$brach_filter){
                    $query->where('transfere_1', '=', $user->branch)
                    ->where('transfere_2',$brach_filter )
                    ->where('elfar3_elmosadad_mno_2','');
                    /*
                        get transfere_cost_2

                    */
                });
        });        
            //saif = shipmnt_cost  - t7weel
        
        if($waselOnly)
            $shipments = $shipments->where('status_' ,'=',7) ;
        else
            $shipments = $shipments->where('status_' ,'!=',8) ;
 
        if(isset($request->mo7afza)){
           $shipments = $shipments->where('mo7afaza_id', '=', $request->mo7afza);       
       }
        $all_shipments = $shipments;
        if($user->type_ =='عميل'){
            if(isset( request()->date_from))
                $all_shipments= $all_shipments->where('date_' ,'>=',DATE($request->date_from) );
            if(isset( request()->date_to))
                $all_shipments= $all_shipments->where('date_' ,'<=' ,DATE($request->date_to) );
        }else{
            if(isset( request()->date_from))
                $all_shipments= $all_shipments->where('tarikh_el7ala' ,'>=',DATE( request()->date_from) );
            if(isset( request()->date_to))
                $all_shipments= $all_shipments->where('tarikh_el7ala' ,'<=',DATE( request()->date_to) );
        }
        $counter= $all_shipments->get();
        // $totalCost = $counter->sum('shipment_coast_');
        // if($user->type_=='عميل')
        //     $tawsilCost = $counter->sum('tawsil_coast_');
        // if($user->type_=='مندوب استلام')
        //     $tawsilCost = $counter->sum('tas3ir_mandoub_estlam');
        // if($user->type_=='مندوب تسليم')
        //     $tawsilCost = $counter->sum('tas3ir_mandoub_taslim');
        
        // $netCost =  $totalCost-$tawsilCost;

        $count_all = $counter->count();
        if(request()->showAll == 'on')
            request()->limit=$count_all;
        $all = $all_shipments->paginate(request()->limit ?? 10);
        
        $all->withPath("?limit={$request->limit}&branch={$brach_filter}&mo7afza={$request->mo7afza}&showAll={$request->showAll}");
        $branches =BranchInfo::all();
        $mo7afazat =Mohfza::all();
        // dd($counter);
        $page_title='الشحنات الغير مسددة للفرع';
        return view('frou3.accounting.notmosadad',compact('all','branches','mo7afazat','brach_filter','waselOnly','page_title'));
    }

    public function tasdid(Request $request){
        
        $user = $user = auth()->user();
        if($user->branch !='الفرع الرئيسى' && $request->brach_filter!=$user->branch)
        {
            return response()->json([
                'status' => 404,
                'message' => 'لم يتم التسديد',
            ], 404); 
        }
        //case 1 
        DB::table('add_shipment_tb_')
        ->whereIn('add_shipment_tb_.code_', $request->code)
        ->where('add_shipment_tb_.branch_' ,$user->branch)
        ->where('add_shipment_tb_.transfere_1' ,$request->brach_filter)
        ->where('add_shipment_tb_.elfar3_elmosadad_mno', '')
            ->update(['add_shipment_tb_.tarikh_tasdid_far3'=>Carbon::now(),
            'add_shipment_tb_.elfar3_elmosadad_mno' =>'مسدد',
            ]);
        DB::table('add_shipment_tb_')
            ->whereIn('add_shipment_tb_.code_', $request->code)
            ->where('transfere_1', '=', $user->branch)
            ->where('transfere_2',$request->brach_filter )
            ->where('add_shipment_tb_.elfar3_elmosadad_mno_2', '')
                ->update(['add_shipment_tb_.tarikh_tasdid_far3_2'=>Carbon::now(),
                'add_shipment_tb_.elfar3_elmosadad_mno_2' =>'مسدد',
            ]);
            
            return response()->json([
                'status' => 200,
                'message' => 'تم التسديد',
            ], 200); 
    }
   
    
    public function AccountingMosadad(Request $request)
    { 
        
        $user=auth()->user();
        $limit=10;
        $brach_filter = 'الفرع الرئيسى';
        if(isset($request->branch))
            $brach_filter= $request->branch;
        $waselOnly=0;
        if(isset($request->waselOnly))
            $waselOnly= 1;
            
        if(isset(request()->limit ))   $limit =request()->limit;
        $shipments = Shipment::select('*',DB::raw("(CASE 
                                    WHEN ( branch_ = '{$user->branch}' and  transfere_1 = '{$brach_filter}' and elfar3_elmosadad_mno != '') THEN  transfer_coast_1
                                    WHEN ( transfere_1 = '{$user->branch}' and  transfere_2 = '{$brach_filter}' and elfar3_elmosadad_mno_2 != '') THEN transfer_coast_2
                                    END) AS t7weel_cost"))
        ->where(function ($query) use($request,$user,$brach_filter){
            $query->where(function ($query) use($request,$user,$brach_filter){
                $query->where('branch_', '=', $user->branch)
                ->where('transfere_1', $brach_filter)
                ->where('elfar3_elmosadad_mno',  '!=' ,'');

                /*
                    get transfere_cost_1

                */
                })
                ->orWhere(function ($query) use($request,$user,$brach_filter){
                    $query->where('transfere_1', '=', $user->branch)
                    ->where('transfere_2',$brach_filter )
                    ->where('elfar3_elmosadad_mno_2','!=' ,'');
                    /*
                        get transfere_cost_2

                    */
                });
        });        
            //saif = shipmnt_cost  - t7weel
        
        if($waselOnly)
            $shipments = $shipments->where('status_' ,'=',7) ;
        else
            $shipments = $shipments->where('status_' ,'!=',8) ;
 
        if(isset($request->mo7afza)){
           $shipments = $shipments->where('mo7afaza_id', '=', $request->mo7afza);       
       }
        $all_shipments = $shipments;
        if($user->type_ =='عميل'){
            if(isset( request()->date_from))
                $all_shipments= $all_shipments->where('date_' ,'>=',DATE($request->date_from) );
            if(isset( request()->date_to))
                $all_shipments= $all_shipments->where('date_' ,'<=' ,DATE($request->date_to) );
        }else{
            if(isset( request()->date_from))
                $all_shipments= $all_shipments->where('tarikh_el7ala' ,'>=',DATE( request()->date_from) );
            if(isset( request()->date_to))
                $all_shipments= $all_shipments->where('tarikh_el7ala' ,'<=',DATE( request()->date_to) );
        }
        $counter= $all_shipments->get();
        // $totalCost = $counter->sum('shipment_coast_');
        // if($user->type_=='عميل')
        //     $tawsilCost = $counter->sum('tawsil_coast_');
        // if($user->type_=='مندوب استلام')
        //     $tawsilCost = $counter->sum('tas3ir_mandoub_estlam');
        // if($user->type_=='مندوب تسليم')
        //     $tawsilCost = $counter->sum('tas3ir_mandoub_taslim');
        
        // $netCost =  $totalCost-$tawsilCost;

        $count_all = $counter->count();
        if(request()->showAll == 'on')
            request()->limit=$count_all;
        $all = $all_shipments->paginate(request()->limit ?? 10);
        
        $all->withPath("?limit={$request->limit}&branch={$brach_filter}&mo7afza={$request->mo7afza}&showAll={$request->showAll}");
        $branches =BranchInfo::all();
        $mo7afazat =Mohfza::all();
        // dd($counter);
        $page_title='الشحنات  المسددة للفرع';
        return view('frou3.accounting.mosadad',compact('all','branches','mo7afazat','brach_filter','waselOnly','page_title'));
    }


    public function cancelTasdid(Request $request){
        
        $user = $user = auth()->user();
        if($user->branch !='الفرع الرئيسى' && $request->brach_filter!=$user->branch)
        {
            return response()->json([
                'status' => 404,
                'message' => 'لم يتم التسديد',
            ], 404); 
        }
        //case 1 
        DB::table('add_shipment_tb_')
        ->whereIn('add_shipment_tb_.code_', $request->code)
        ->where('add_shipment_tb_.branch_' ,$user->branch)
        ->where('add_shipment_tb_.transfere_1' ,$request->brach_filter)
        ->where('add_shipment_tb_.elfar3_elmosadad_mno','!=', '')
            ->update(['add_shipment_tb_.tarikh_tasdid_far3'=>'',
            'add_shipment_tb_.elfar3_elmosadad_mno' =>'',
        ]);
        DB::table('add_shipment_tb_')
            ->whereIn('add_shipment_tb_.code_', $request->code)
            ->where('transfere_1', '=', $user->branch)
            ->where('transfere_2',$request->brach_filter )
            ->where('add_shipment_tb_.elfar3_elmosadad_mno_2','!=' ,'')
                ->update(['add_shipment_tb_.tarikh_tasdid_far3_2'=>'',
                'add_shipment_tb_.elfar3_elmosadad_mno_2' =>'',
            ]);
            
            return response()->json([
                'status' => 200,
                'message' => 'تم التسديد',
            ], 200); 
    }
     //end acc
}