<?php

namespace App\Http\Controllers\Api\general;

use App\CustomClass\response;
use App\Http\Controllers\Api\site\Controller;
use App\Models\BranchInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Validation\Rule;
use App\Models\Doctor;
use App\Models\Mantikqa;
use App\Models\Mohfza;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;

class BranchController extends Controller
{
    public function allbranch(Request $request){
     
            $branches =  BranchInfo::select('name_','name_E','code_')->get();
            
           
           
            // return $moh;
            foreach($branches as $branch )
            {
               $moh_det = Mohfza::select('code','name','branch')->where('branch',$branch->name_)->get();
               $branch['mohfza'] = $moh_det;
               foreach ($moh_det as $m)
               { 
               $mantika = Mantikqa::select('name','branch','serial_')->where('branch',$branch->name_)->get();
                    $m['mantika'] = $mantika;

               }
            }

            return response::suceess('success', 200,"Allbranch",$branches);


        }
        public function commerical(Request $request)
        {
            $all = DB::table('add_commercial_names_tb')->get();
            return response::suceess('success', 200,"Allcommeric",$all);

        }
       
    }

    