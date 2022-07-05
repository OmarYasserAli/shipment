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
use App\User;
use App\Models\Khazna;
use App\Models\Branch_user;
use App\Models\Sanad;

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
        $sanad= new Sanad();
        if($request->mostafed_type =='عميل' || $request->mostafed_type =='مندوب'){
            $model= user::where('code_',$request->mostafed_name)->first();
           
        }
        
        if($request->mostafed_type =='فرع'){
          $model =BranchInfo::where('code_',$request->mostafed_name)->first();
        }
        
        $sanad->code = 5;
        $sanad->date = Carbon::now()->format('Y-m-d  g:i:s A');
        $sanad->type = $request->page_type;	
        $sanad->khazna_id = $request->khazna_id;
        $sanad->amount = $request->amount;

        $sanad->save();

        // dd($model);
        $model->sanadat()->save($sanad);
        // $sanad->sanadable->save($model);

        return back();
    }

    public function getMostafedBytype(){
        $data = '';
        $user = auth()->user();
        if(request()->mostafed_type =='عميل'){
            $data =  User::where('type_','عميل')->where('branch',$user->branch)->get();
        }
        if(request()->mostafed_type =='مندوب'){
            $data =  User::where('branch',$user->branch)->where('type_','مندوب استلام')->orWhere('type_','مندوب تسليم')->get();
            
        }
        if(request()->mostafed_type =='فرع'){
            $data = BranchInfo::all();
        }

        return response()->json([
            'status' => 200,
            'data' => $data,
        ],200);


    }
}