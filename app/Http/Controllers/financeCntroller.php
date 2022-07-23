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
use App\Models\Sanad;
use App\Models\Sanad_3amil;
use App\Models\Sanad_taslim;
use App\Models\Sanad_far3;
use App\Models\Branch_user;
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
class financeCntroller extends Controller
{
    public function kashf_5azna(){

        $khaznat= Khazna::all();
        $sanadat =[];
        $date_from = Carbon::now()->format('y-m-d');
        $date_to = Carbon::now()->addDays(1)->format('y-m-d');
        $safiKhazna = 0;

        if(isset(request()->date_from)){
            $date_from = request()->date_from;
        }
        if(isset(request()->date_to)){
            $date_to = request()->date_to;
        } 
        // dd($date_from);
        if(isset(request()->khazna_id)){
            $khazna=Khazna::where('id', request()->khazna_id)->first();
            $sanadat = Sanad::with(['sanadable'])->where('khazna_id', request()->khazna_id)
            // ->where('created_at', '>', $date_from)
            // ->where('created_at', '<=' , $date_to)->orderBy('created_at')->get();
            ->whereBetween('created_at', [ $date_from,  $date_to])->orderBy('created_at')->get();
            $safiKhazna =$this->khaznaNet($khazna,$date_from);
            
        }
        if(isset(request()->arba7)){
            return response()->json([
                'status' => 200,
              
                'message' => 'sucecss',
                'safiKhazna'=>$safiKhazna
            ], 200);
        }

        $page_title='كشف حساب خزية';
        return view('accounting.company.kashf-5azna',compact('sanadat','khaznat','safiKhazna','page_title'));
    }

    public function kashf_7sab(Request $request){

        $khaznat= Khazna::all();
        $sanadat =[];
        $date_from = Carbon::now()->format('y-m-d');
        $date_to = Carbon::now()->addDays(1)->format('y-m-d');
        $safi7sab = 0;
        $type7sab=''; $owner = '';
        $clients=User::where('type_','عميل')->get();
        $mandoubs=User::where('type_','مندوب تسليم')->get();

        
        $branches=BranchInfo::all();
        if(isset(request()->date_from)){
            $date_from = new Carbon(request()->date_from); 
        }
       
        if(isset(request()->date_to)){
            $date_to = new Carbon(request()->date_to);
            $date_to =  $date_to ->addDays(1)->format('y-m-d'); 
        }
       
        if(isset(request()->type)){
            if(request()->type =='عميل'){
                // $user = User::where('code_' ,  $request->owner)->first();
                $sanadat = Sanad_3amil::where('client_id',  $request->owner)
                ->whereBetween('created_at', [ $date_from,  $date_to])->orderBy('created_at')->get();
                $safi7sab =$this->hesabNet(Sanad_3amil::where('client_id',  $request->owner),$date_from);
                $owner = User::where('code_',$request->owner)->first()->name_;
            }
            if(request()->type =='مندوب'){
                // $user = User::where('code_' ,  $request->owner)->first();
                $sanadat = Sanad_taslim::where('mandoub_id',  $request->owner)
                ->whereBetween('created_at', [ $date_from,  $date_to])->orderBy('created_at')->get();
                $safi7sab =$this->hesabNet(Sanad_taslim::where('mandoub_id',  $request->owner),$date_from);
                $owner = User::where('code_',$request->owner)->first()->name_;
            }
            if(request()->type =='فرع'){
                $user = auth()->user();
                $far3= BranchInfo::where('name_',$user->branch)->first();
                $far3_from =$far3->code_;
                $q = Sanad_far3::where('far3_id',  $request->owner)->where('far3_from',   $far3_from);
                
                $sanadat= $q->whereBetween('created_at', [ $date_from,  $date_to])->orderBy('created_at')->get();

                $safi7sab =$this->hesabNet(Sanad_far3::where('far3_id',  $request->owner)->where('far3_from',   $far3_from),$date_from);
                $owner = BranchInfo::where('code_',$request->owner)->first()->name_;
            }
            $type7sab= request()->type;
            
        }

        $page_title='كشف حساب';
        return view('accounting.company.kashf-7sab',compact('clients','branches','mandoubs','khaznat','owner'));
    }
    public function Arba7(Request $request){

        $khaznat= Khazna::all();
        $sanadat =[];
        $date_from = Carbon::now()->format('y-m-d');
        $date_to = Carbon::now()->addDays(1)->format('y-m-d');
        $safi7sab = 0;
        $type7sab=''; $owner = '';
        $clients=User::where('type_','عميل')->get();
        $mandoubs=User::where('type_','مندوب تسليم')->get();

        
        $branches=BranchInfo::all();
        if(isset(request()->date_from)){
            $date_from = new Carbon(request()->date_from); 
        }
       
        if(isset(request()->date_to)){
            $date_to = new Carbon(request()->date_to);
            $date_to =  $date_to ->addDays(1)->format('y-m-d'); 
        }
       
        if(isset(request()->type)){
            if(request()->type =='عميل'){
                // $user = User::where('code_' ,  $request->owner)->first();
                $sanadat = Sanad_3amil::where('client_id',  $request->owner)
                ->whereBetween('created_at', [ $date_from,  $date_to])->orderBy('created_at')->get();
                $safi7sab =$this->hesabNet(Sanad_3amil::where('client_id',  $request->owner),$date_from);
                $owner = User::where('code_',$request->owner)->first()->name_;
            }
            if(request()->type =='مندوب'){
                // $user = User::where('code_' ,  $request->owner)->first();
                $sanadat = Sanad_taslim::where('mandoub_id',  $request->owner)
                ->whereBetween('created_at', [ $date_from,  $date_to])->orderBy('created_at')->get();
                $safi7sab =$this->hesabNet(Sanad_taslim::where('mandoub_id',  $request->owner),$date_from);
                $owner = User::where('code_',$request->owner)->first()->name_;
            }
            if(request()->type =='فرع'){
                $user = auth()->user();
                $far3= BranchInfo::where('name_',$user->branch)->first();
                $far3_from =$far3->code_;
                $q = Sanad_far3::where('far3_id',  $request->owner)->where('far3_from',   $far3_from);
                
                $sanadat= $q->whereBetween('created_at', [ $date_from,  $date_to])->orderBy('created_at')->get();

                $safi7sab =$this->hesabNet(Sanad_far3::where('far3_id',  $request->owner)->where('far3_from',   $far3_from),$date_from);
                $owner = BranchInfo::where('code_',$request->owner)->first()->name_;
            }
            $type7sab= request()->type;
            
        }

        $page_title='كشف حساب';
        return view('accounting.company.arba7',compact('clients','branches','mandoubs','khaznat','owner'));
    }
    
    public function get7sabOwners(Request $request){

        $user = auth()->user();
        if($request->type =='عميل'){
            $data = User::where('branch',$user->branch)->where('type_','عميل')->get();
        }
        if($request->type =='مندوب'){
            $data = User::where('branch',$user->branch)->where('type_','مندوب تسليم')->get();
        }
        if($request->type =='فرع'){
            $data = BranchInfo::all();
        }
        return response()->json([
            'status' => 200,
            'data' => $data,
        ], 200);
    }

    
    public function khaznaNet($khazna,$date=null){
        $net=0;
        $sanadat=  $khazna->sanadat();
        if($date != null)
            $sanadat =  $sanadat->where('created_at', '<' ,$date);
        $sanadat =  $sanadat->get();
        
        foreach($sanadat as $sanad){
            if($sanad->type =='قبض')
                $net+=$sanad->amount ;
            else
                $net-=$sanad->amount ;

        }
        return $net;
    }

    public function hesabNet($q,$date=null){
        $net=0;
        $sanadat=  $q;
       
        if($date != null){
            $d =new Carbon($date);
            $d=$d->format('y-m-d');
            $sanadat =  $q->where('created_at', '<' , $d );
        }
        $sanadat =  $sanadat->get();
        
        foreach($sanadat as $sanad){
            if($sanad->type =='قبض')
                $net+=$sanad->amount ;
            else
                $net-=$sanad->amount ;

        }
        return $net;
    }
    
}
