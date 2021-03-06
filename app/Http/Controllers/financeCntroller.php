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
use App\Models\Sanad_masaref;
use App\Models\Sanad_o5ra;
use App\Models\Branch_user;
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
class financeCntroller extends Controller
{
    public function kashf_5azna(){
        $user = auth()->user();
        $b = BranchInfo::where('name_',$user->branch)->first();
        $khaznat= Khazna::where('branch_id',$b->code_)->get();
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

        $page_title='?????? ???????? ????????';
        return view('accounting.company.kashf-5azna',compact('sanadat','khaznat','safiKhazna','page_title'));
    }

    public function kashf_7sab(Request $request){

        $khaznat= Khazna::all();
        $sanadat =[];
        $date_from = Carbon::now()->format('y-m-d');
        $date_to = Carbon::now()->addDays(1)->format('y-m-d');
        $safi7sab = 0;
        $type7sab=''; $owner = '';
        $clients=User::where('type_','????????')->get();
        $mandoubs=User::where('type_','?????????? ??????????')->get();

        
        $branches=BranchInfo::all();
        if(isset(request()->date_from)){
            $date_from = new Carbon(request()->date_from); 
        }
       
        if(isset(request()->date_to)){
            $date_to = new Carbon(request()->date_to);
            $date_to =  $date_to ->addDays(1)->format('y-m-d'); 
        }
       
        if(isset(request()->type)){
            if(request()->type =='????????'){
                // $user = User::where('code_' ,  $request->owner)->first();
                $sanadat = Sanad_3amil::where('client_id',  $request->owner)
                ->whereBetween('created_at', [ $date_from,  $date_to])->orderBy('created_at')->get();
                $safi7sab =$this->hesabNet(Sanad_3amil::where('client_id',  $request->owner),$date_from);
                $owner = User::where('code_',$request->owner)->first()->name_;
            }
            if(request()->type =='??????????'){
                // $user = User::where('code_' ,  $request->owner)->first();
                $sanadat = Sanad_taslim::where('mandoub_id',  $request->owner)
                ->whereBetween('created_at', [ $date_from,  $date_to])->orderBy('created_at')->get();
                $safi7sab =$this->hesabNet(Sanad_taslim::where('mandoub_id',  $request->owner),$date_from);
                $owner = User::where('code_',$request->owner)->first()->name_;
            }
            if(request()->type =='??????'){
                $user = auth()->user();
                $far3= BranchInfo::where('name_',$user->branch)->first();
                $far3_from =$far3->code_;
                $q = Sanad_far3::where('far3_id',  $request->owner)->where('far3_from',   $far3_from);
                
                $sanadat= $q->whereBetween('created_at', [ $date_from,  $date_to])->orderBy('created_at')->get();

                $safi7sab =$this->hesabNet(Sanad_far3::where('far3_id',  $request->owner)->where('far3_from',   $far3_from),$date_from);
                $owner = BranchInfo::where('code_',$request->owner)->first()->name_;
            }
            if(request()->type =='????????????'){
                $user = auth()->user();
                 $far3= BranchInfo::where('name_',$user->branch)->first();
                // $far3_from =$far3->code_;
                $q = Sanad_masaref::where('masaref_id',  $request->owner);
                
                $sanadat= $q->whereBetween('created_at', [ $date_from,  $date_to])->orderBy('created_at')->get();

                $safi7sab =$this->hesabNet(Sanad_masaref::where('masaref_id',  $request->owner),$date_from);
                $owner = Masaref::where('code_',$request->owner)->first()->name_;
            }
            if(request()->type =='????????'){
                $user = auth()->user();
                 $far3= BranchInfo::where('name_',$user->branch)->first();
                // $far3_from =$far3->code_;
                $q = Sanad_o5ra::where('o5ra_id',  $request->owner);
                
                $sanadat= $q->whereBetween('created_at', [ $date_from,  $date_to])->orderBy('created_at')->get();

                $safi7sab =$this->hesabNet(Sanad_o5ra::where('o5ra_id',  $request->owner),$date_from);
                $owner = O5ra_7sabat::where('code_',$request->owner)->first()->name_;
            }

            
            $type7sab= request()->type;
            
        }

        $page_title='?????? ????????';
        return view('accounting.company.kashf-7sab',compact('clients','branches','mandoubs','khaznat','owner','page_title',
        'sanadat','safi7sab','type7sab'));
    }
    public function Arba7(Request $request){

        $khaznat= Khazna::all();
        $sanadat =[];
        $date_from = Carbon::now()->format('y-m-d');
        $date_to = Carbon::now()->addDays(1)->format('y-m-d');
        $safi7sab = 0;
        $type7sab=''; $owner = '';
        $clients=User::where('type_','????????')->get();
        $mandoubs=User::where('type_','?????????? ??????????')->get();

        
        $branches=BranchInfo::all();
        if(isset(request()->date_from)){
            $date_from = new Carbon(request()->date_from); 
        }
       
        if(isset(request()->date_to)){
            $date_to = new Carbon(request()->date_to);
            $date_to =  $date_to ->addDays(1)->format('y-m-d'); 
        }
       
        if(isset(request()->type)){
            if(request()->type =='????????'){
                // $user = User::where('code_' ,  $request->owner)->first();
                $sanadat = Sanad_3amil::where('client_id',  $request->owner)
                ->whereBetween('created_at', [ $date_from,  $date_to])->orderBy('created_at')->get();
                $safi7sab =$this->hesabNet(Sanad_3amil::where('client_id',  $request->owner),$date_from);
                $owner = User::where('code_',$request->owner)->first()->name_;
            }
            if(request()->type =='??????????'){
                // $user = User::where('code_' ,  $request->owner)->first();
                $sanadat = Sanad_taslim::where('mandoub_id',  $request->owner)
                ->whereBetween('created_at', [ $date_from,  $date_to])->orderBy('created_at')->get();
                $safi7sab =$this->hesabNet(Sanad_taslim::where('mandoub_id',  $request->owner),$date_from);
                $owner = User::where('code_',$request->owner)->first()->name_;
            }
            if(request()->type =='??????'){
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

        $page_title='?????? ????????';
        return view('accounting.company.arba7',compact('clients','branches','mandoubs','khaznat','owner'));
    }
    
    public function get7sabOwners(Request $request){

        $user = auth()->user();
        $b = BranchInfo::where('name_',$user->branch)->first();
        if($request->type =='????????'){
            $data = User::where('branch',$user->branch)->where('type_','????????')->get();
        }
        if($request->type =='??????????'){
            $data = User::where('branch',$user->branch)->where('type_','?????????? ??????????')->get();
        }
        if($request->type =='??????'){
            $data = BranchInfo::all();
        }
        if($request->type =='????????'){
            $data = O5ra_7sabat::where('branch_id',$b->code_)->get();
        }
        if($request->type =='????????????'){
            $data = Masaref::where('branch_id',$b->code_)->get();
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
            if($sanad->type =='??????')
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
            if($sanad->type =='??????')
                $net+=$sanad->amount ;
            else
                $net-=$sanad->amount ;

        }
        return $net;
    }
    
}
