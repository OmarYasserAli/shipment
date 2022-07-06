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
        }
        $safiKhazna =$this->khaznaNet($khazna,$date_from);
        
        return view('accounting.company.kashf-5azna',compact('sanadat','khaznat','safiKhazna'));
    }



    public function khaznaNet($khazna,$date=null){
        $net=0;
        $sanadat=  $khazna->sanadat();
        if($date != null)
            $sanadat =  $sanadat->where('created_at', '<' ,$date);
        $sanadat =  $sanadat->get();
        // dd( $sanadat);
        foreach($sanadat as $sanad){
            if($sanad->type =='قبض')
                $net+=$sanad->amount ;
            else
                $net-=$sanad->amount ;

        }
        return $net;
    }
}