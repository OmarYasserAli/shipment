<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MandoubEstlam;
use App\Models\MandoubTaslim;
use App\User;
use App\Models\Mohfza;
use App\Models\Mantikqa;
use App\Models\Tas3ir_3amil;
use App\Models\Tas3ir_3amil_5as;
use App\Models\Tas3ir_ta7wel;
use App\Models\AddClientsMainComp;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class tas3irController extends Controller
{

        public function save_3amel(Request $request)
        {

        	$tas3ir = Tas3ir_3amil::find($request->code);
                $tas3ir->price_= $request->value;
                $tas3ir->save();
        }
        public function save_ta7wel(Request $request)
        {

        	$tas3ir = Tas3ir_ta7wel::find($request->code);
                $tas3ir->price_= $request->value;
                $tas3ir->save();

        }
        public function tas3ir_3amil_5as()
        {
                $user=auth()->user();
                if(!$user->isAbleTo('tas3ir3amel5as-definations')){
                return abort(403);
                }
        	$branch = Auth::user()->branch;
        	$cities=Mohfza::groupBy('name')->get();
        	$specialClients = User::groupBy('name_')->where('Special_prices','!=','لا' )->where('branch',$branch)->get();
      	        return view('tas3ir.3amil_5as',compact('cities','specialClients'));
        }
        public function tas3ir_mandouben(Request $request)
    {

        $cities=Mohfza::groupBy('name')->get();
        return view('tas3ir.mandoub',compact('cities'));

    }

    public function getNameByType(Request $request,$id=1)
    {
        $branch = Auth::user()->branch;
        if ($request->id == 1){
            $mandoubName = MandoubEstlam::groupBy('mandoub_name_')->where('branch',$branch)->get();
            return response()->json($mandoubName);

        }elseif ($request->id == 2){
            $mandoubName = MandoubTaslim::groupBy('mandoub_name_')->where('branch',$branch)->get();
            return response()->json($mandoubName);
        }elseif ($id == 0){

            return response()->json(null);
        }


    }

    public function saveMandobe(Request $request)
    {


        if ($request->mandobeType == 1){
            if ($request->serial == 0){
             return   $mandobe_name = MandoubEstlam::where('mandoub_ID',$request->mandobe)->get();
                $branch = Auth::user()->branch;
                MandoubEstlam::create([
                    'code_'=>15,
                    'area_name_'=>$request->manteqa,
                    'city_name_'=>$request->mo7afza,
                    'price_'=>$request->value,
                    'branch'=>$branch,
                    'mandoub_name_'=>$mandobe_name[0]['mandoub_name_'],
                    'mandoub_ID'=>$request->mandobe,

                ]);
                return response()->json([
                    'status' => 200,
                    'message' => 'success',
                ], 200);
            }else {
                $tas3ir = MandoubEstlam::find($request->mandobe)->where('serial_',$request->serial);
                $tas3ir->update([
                    'price_' => $request->value,
                ]);
                return response()->json([
                    'status' => 200,
                    'message' => 'success',
                ], 200);
            }
        } elseif ($request->mandobeType == 2){
            if ($request->serial == 0){
                $mandobe_name = MandoubTaslim::where('mandoub_ID',$request->mandobe)->get();

                MandoubTaslim::create([
                    'code_'=>15,
                    'area_name_'=>$request->manteqa,
                    'city_name_'=>$request->mo7afza,
                    'price_'=>$request->value,
                    'branch'=>'الفرع الرئيسى',
                    'mandoub_name_'=>$mandobe_name[0]['mandoub_name_'],
                    'mandoub_ID'=>$request->mandobe,
                    'mo7afaza_id'=> 10,
                    'mantika_id'=>10
                ]);
                return response()->json([
                    'status' => 200,
                    'message' => 'success',
                ], 200);
            }else{
            $tas3ir = MandoubTaslim::find($request->mandobe)->where('serial_',$request->serial);
            $tas3ir->update([
                'price_' => $request->value,
            ]);
            return response()->json([
                'status' => 200,
                'message' => 'success',
            ], 200);
            }

        }

    }



    public function save_3amel_5as(Request $request){
//return  $request;
        if ($request->serial == 0){
             $specialClient = User::where('code_',$request->specialClient)->first();
             $branch = Auth::user()->branch;
            Tas3ir_3amil_5as::create([
                'area_name_'=>$request->manteqa,
                'city_name_'=>$request->mo7afza,
                'price_'=>$request->value,
                'branch'=>$branch,
                'name'=>$specialClient->name_,
                'mandoub_ID'=>$request->specialClient,
                'type'=>'عملاء'

            ]);
            return response()->json([
                'status' => 200,
                'message' => 'success',
            ], 200);
        }else {

            $tas3ir = Tas3ir_3amil_5as::where('code_',$request->serial)->where('mandoub_ID',$request->specialClient)->
      where('city_name_',$request->mo7afza)->where('area_name_',$request->manteqa)->first();

            $tas3ir->update([
                'price_' => $request->value,
            ]);
            return response()->json([
                'status' => 200,
                'message' => 'success',
            ], 200);
        }

        }

    public function getManateqAndTas3irMandobByMa7afza( )
    {
        $mo7afza=request()->mo7afza;

        $mandobe = request()->mandobe;
        $mandobeType = request()->mandobeType;
        if ($mandobeType == 1){
            $manatek =Mantikqa::where('mo7afza',$mo7afza)->where('branch','الفرع الرئيسى')->get();
            $mandobeEstilam =MandoubEstlam::where('city_name_',$mo7afza)->where('mandoub_ID',$mandobe)->where('branch','الفرع الرئيسى')->get();

            return response()->json([
                'status' => 200,
                'message' => 'success',
                'all' => $manatek,
                'mandobe'=>$mandobeEstilam,
                'sum' => count($manatek),
                'manbobeType'=>1
            ], 200);
        }elseif ($mandobeType == 2){
            $manatek =Mantikqa::where('mo7afza',$mo7afza)->where('branch','الفرع الرئيسى')->get();
            $mandobeTaslim =MandoubTaslim::where('city_name_',$mo7afza)->where('mandoub_ID',$mandobe)->where('branch','الفرع الرئيسى')->get();

            return response()->json([
                'status' => 200,
                'message' => 'success',
                'all' => $manatek,
                'mandobe'=>$mandobeTaslim,
                'sum' => count($manatek),
                'manbobeType'=>2
            ], 200);
        }






    }

        public function getManateqAndTas3ir5asByMa7afza( )
        {
                $mo7afza=request()->mo7afza;
                $specialClientRequest = request()->specialClient;
                  $specialClientsBranch = User::where('code_',$specialClientRequest )->first();
                $branch = Auth::user()->branch;
                $manatek =Mantikqa::where('mo7afza',$mo7afza)->where('branch',$branch)->get();

                $specialClient =Tas3ir_3amil_5as::where('city_name_',$mo7afza)->where('mandoub_ID',$specialClientRequest)->where('branch',$branch)->get();

                return response()->json([
                'status' => 200,
                'message' => 'success',
                'all' => $manatek,
                'mandobe'=>$specialClient,
                'sum' => count($manatek)
                ], 200);



        }


}
