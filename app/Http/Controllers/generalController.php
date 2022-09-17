<?php

namespace App\Http\Controllers;

use App\Models\UserHistory;
use Illuminate\Http\Request;
use App\Models\Mohfza;
use App\Models\Mantikqa;
use App\User;
use App\Models\Commercial_name;
use App\Models\Tas3ir_3amil;


use App\Models\AddClientsMainComp;
use Illuminate\Support\Facades\DB;

class generalController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getManateqByMa7afza( )
    {
        $user= auth()->user();

        $mo7afza=request()->mo7afza;
        if(request()->bycode=="1"){
            $chosen_Mohfza=Mohfza::where('code',$mo7afza)->where('branch',$user->branch)->first();

            $manatek =Mantikqa::with('Tas3ir_3amil' ,'Tas3ir_ta7wel')->where('mo7afza',$chosen_Mohfza->name)->where('branch',$user->branch)->get();
        }
        else
            $manatek =Mantikqa::with('Tas3ir_3amil' ,'Tas3ir_ta7wel')->where('mo7afza',$mo7afza)->where('branch',$user->branch)->get();

            foreach($manatek as $m){


            if(!isset($m->Tas3ir_3amil )){
                $t = new Tas3ir_3amil();
                $t->area_name_ =  $m->name;
                $t->city_name_ = $mo7afza ;
                $t->branch =$user->branch ;
                $t->price_ =0 ;
                $nCode = Tas3ir_3amil::max('code_');
                $t->code_ =$nCode+1;

                $t->save();

            }

            if(!isset($m->Tas3ir_ta7wel )){
                $t = new Tas3ir_ta7wel();
                $t->area_name_ =  $m->name;
                $t->city_name_ = $mo7afza ;
                $t->branch =$user->branch ;
                $t->price_ =0 ;
                $nCode = Tas3ir_ta7wel::max('code_');
                $t->code_ =$nCode+1;
                
                $t->mo7afaza_id =0 ;
                $t->mantika_id =0 ;
                
                $t->save();

            }
            if(request()->bycode=="1"){
                $chosen_Mohfza=Mohfza::where('code',$mo7afza)->where('branch',$user->branch)->first();

                $manatek =Mantikqa::with('Tas3ir_3amil' ,'Tas3ir_ta7wel')->where('mo7afza',$chosen_Mohfza->name)->where('branch',$user->branch)->get();
            }
            else
                $manatek =Mantikqa::with('Tas3ir_3amil' ,'Tas3ir_ta7wel')->where('mo7afza',$mo7afza)->where('branch',$user->branch)->get();

        }
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'all' => $manatek,
            'sum' => count($manatek),
        ], 200);

    }
    public function getCommertialnameBy3amil( )
    {
        $client_id=request()->client_id;

        if(request()->bycode=="1"){

            $filtered_clients = User::where('type_','عميل')->where('code_',$client_id)->pluck('code_')->toArray();
        }else
            $filtered_clients = User::where('type_','عميل')->where('name_',$client_id)->pluck('code_')->toArray();

        $Commercial_names =Commercial_name::whereIn('code_',$filtered_clients)->groupBy('name_')->get();

        return response()->json([
            'status' => 200,
            'message' => 'success',
            'all' => $Commercial_names,
            'sum' => count($Commercial_names),
        ], 200);

    }
    public function getTawsilByManteka(){
        $user= auth()->user();

        $client_id=request()->client_id;
        $mo7afza=request()->mo7afza_id;
        $manatek=request()->manteka_id;
        if(request()->bycode=="1"){

            $mo7afza=Mohfza::where('code',$mo7afza)->first()->name;
            $manatek=Mantikqa::where('code',$manatek)->first()->name;
        }
       $isSprecial = User::where('code_',$client_id)->first();

        if(isset($isSprecial))
            if($isSprecial->Special_prices == 'لا'){
               {
                $price = DB::table('prices_tb')
                ->where('area_name_', $manatek)
                ->where('city_name_',$mo7afza)
                ->where('branch', $user->branch)
                ->select('price_')->first();

               }
            }else{
                $price = DB::table('special_prices_tb')
                ->where('area_name_', $manatek)
                ->where('city_name_',$mo7afza)
                ->where('mandoub_ID', $client_id)
                ->select('price_')->first();
            }
        else
            $price = DB::table('special_prices_tb')
            ->where('area_name_', $manatek)
            ->where('city_name_',$mo7afza)
            ->where('mandoub_ID', $client_id)
            ->select('price_')->first();

        if(isset($price))
            $price=$price->price_;
        else
            $price=0;
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'all' => $price,
        ], 200);
    }

    public function changeAdminBranch(Request $request){

        if(auth()->user()->username =='Superuser' )
        {
            $u=User::where('username' ,'Superuser')->first();

            $u->branch =$request->branch;
            $u->save();

            UserHistory::create([
                "user_id" => auth()->user()->code_,
                "action_name" => "تغير فرع الادمن",
                "action_desc" =>  "تم تغير فرع الادمن",
                "branch" => auth()->user()->branch
            ]);
            return response()->json([
                'status' => 200,
                'message' => 'success',

            ], 200);
        }
    }


    public function toggleDarkMode(){
       
        if(session('darkmode') == 1 ){
            session(['darkmode' => 0]);
            return response()->json([
                'darkmode' => 0,

            ], 200);
        }else{
           
            session(['darkmode' => 1]);
           // dd(session('darkmode'));
            return response()->json([
                'darkmode' => 1,

            ], 200);
        }
    }



}
