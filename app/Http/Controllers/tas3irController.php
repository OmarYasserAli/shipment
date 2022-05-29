<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use App\Models\Mohfza;
use App\Models\Mantikqa;
use App\Models\Tas3ir_3amil;
use App\Models\Tas3ir_3amil_5as;
use App\Models\Tas3ir_ta7wel;


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
        	$cities=Mohfza::groupBy('name')->get();
        	return view('tas3ir.3amil_5as',compact('cities'));
        }
        public function save_3amel_5as(Request $request){
                $tas3ir = Tas3ir_3amil_5as::find($request->code);
                $tas3ir->price_= $request->value;
                $tas3ir->save();
        }

        

        public function getManateqAndTas3ir5asByMa7afza( )
    {
        $mo7afza=request()->mo7afza;
        
        $manatek =Mantikqa::with('Tas3ir_3amil_5as')->where('mo7afza',$mo7afza)->where('branch','الفرع الرئيسى')->get();
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'all' => $manatek,
            'sum' => count($manatek),
        ], 200); 
        
    }

       
}
