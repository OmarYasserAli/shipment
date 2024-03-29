<?php

namespace App\Http\Controllers;

use App\CustomClass\response;
use App\Http\Controllers\Api\site\Controller;
use App\Models\BranchInfo;
use App\Models\Mantikqa;
use App\Models\Mohfza;
use App\Models\Shipment;
use App\Models\AllUser;
use App\Models\Shipment_status;
use App\Models\Commercial_name;
use App\Models\Archive;
use App\Models\UserHistory;
use App\User;
use App\Models\Khazna;
use App\Models\Branch_user;
use App\Models\Sanad;
use App\Models\Sanad_3amil;
use App\Models\Sanad_taslim;
use App\Models\Sanad_far3;
use App\Models\Sanad_o5ra;
use App\Models\Sanad_masaref;


use App\Models\O5ra_7sabat;
use App\Models\Masaref;


use QrCode;

use Carbon\Carbon;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use PDF;
class sanadatController extends Controller
{
    public function createQabad(){
        $page_title='سند قبض';
        $user=auth()->user();
        $khaznat=$user->Khazna;

        return view('accounting.company.sanadQabad',compact('page_title','khaznat'));
    }
    public function createSarf(){
        $page_title='سند صرف';
        $user=auth()->user();
        $khaznat=$user->Khazna;
        return view('accounting.company.sanadSarf',compact('page_title','khaznat'));
    }
    public function store(Request $request){
        $user=auth()->user();
        $sanad= new Sanad();
        if($request->mostafed_type =='عميل' ){
            $model= user::where('code_',$request->mostafed_name)->first();
           $sanad2 = new Sanad_3amil();
           $sanad2->client_id = $request->mostafed_name ;

            UserHistory::create([
                "user_id" => auth()->user()->code_,
                "action_name" => "انشاء سند عميل",
                "action_desc" =>  "  تم انشاء سند عميل الى".$model->name_,
                "branch" => auth()->user()->branch
            ]);
        }
        if($request->mostafed_type =='مندوب'){
            $model= user::where('code_',$request->mostafed_name)->first();
            $sanad2 = new Sanad_taslim();
            $sanad2->mandoub_id = $request->mostafed_name ;

            UserHistory::create([
                "user_id" => auth()->user()->code_,
                "action_name" => "انشاء سند مندوب",
                "action_desc" =>  "  تم انشاء سند مندوب الى".$model->name_,
                "branch" => auth()->user()->branch
            ]);
        }

        if($request->mostafed_type =='فرع'){
          $model =BranchInfo::where('code_',$request->mostafed_name)->first();
          $sanad2 = new Sanad_far3();
          $sanad2->far3_id = $request->mostafed_name ;
          $sanad2->far3_from = BranchInfo::where('name_',$user->branch)->first()->code_;


            UserHistory::create([
                "user_id" => auth()->user()->code_,
                "action_name" => "انشاء سند فرع",
                "action_desc" =>  "  تم انشاء سند فرع الى".$model->name_,
                "branch" => auth()->user()->branch
            ]);
        }
        if($request->mostafed_type =='اخرى'){
            $model =O5ra_7sabat::where('code_',$request->mostafed_name)->first();
            $sanad2 = new Sanad_o5ra();
            $sanad2->o5ra_id = $request->mostafed_name ;

            UserHistory::create([
                "user_id" => auth()->user()->code_,
                "action_name" => "انشاء سند اخرى",
                "action_desc" =>  "  تم انشاء سند اخرى الى".$model->name_,
                "branch" => auth()->user()->branch
            ]);
          }
          if($request->mostafed_type =='مصاريف'){
            $model =Masaref::where('code_',$request->mostafed_name)->first();
            $sanad2 = new Sanad_masaref();
            $sanad2->masaref_id = $request->mostafed_name ;

              UserHistory::create([
                  "user_id" => auth()->user()->code_,
                  "action_name" => "انشاء سند عميل",
                  "action_desc" =>  "  تم انشاء سند مصاريف الى".$model->name_,
                  "branch" => auth()->user()->branch
              ]);
          }
        $sanad->code = (Sanad::orderBy('id' ,'desc')->first()->code)+1;
        $sanad->date = Carbon::now()->format('Y-m-d  g:i:s A');
        $sanad->type = $request->page_type;
        $sanad->khazna_id = $request->khazna_id;
        $sanad->amount = $request->amount;
        $sanad->is_solfa = $request->is_solfa;
        $sanad->notes = $request->notes;
        $khazna = Khazna::findOrFail($request->khazna_id);

        if($request->page_type =='صرف'   && $khazna->net() < $request->amount){

            return back()->with('error','لا يوجد رصيد كافي في الخزينة');
        }

        $sanad->save();

        // dd($model);
        $model->sanadat()->save($sanad);
        // $sanad->sanadable->save($model);


        $sanad2->amount = $request->amount ;
        $sanad2->code =  $sanad->code;
        $sanad2->type = $request->page_type;
        $sanad2->is_solfa = $request->is_solfa;
        $sanad2->note = $request->notes;
        $sanad2->save();
        return back()->with('status','تمت العملية بنجاح');
    }

    public function getMostafedBytype(){
        $data = '';
        $user = auth()->user();
        $b = BranchInfo::where('name_',$user->branch)->first();
        if(request()->mostafed_type =='عميل'){
            $data =  User::where('type_','عميل')->where('branch',$user->branch)->get();
        }
        if(request()->mostafed_type =='مندوب'){

            $data =  User::where('branch',$user->branch)->where(function ($query) {
                $query ->where('type_','مندوب استلام')->orWhere('type_','مندوب تسليم');
            })->get();

        }
        if(request()->mostafed_type =='فرع'){
            $data = BranchInfo::all();
        }
        if(request()->mostafed_type =='اخرى'){
            $data = O5ra_7sabat::where('branch_id',$b->code_)->get();
        }
        if(request()->mostafed_type =='مصاريف'){
            $data = Masaref::where('branch_id',$b->code_)->get();
        }


        return response()->json([
            'status' => 200,
            'data' => $data,
        ],200);


    }
}
