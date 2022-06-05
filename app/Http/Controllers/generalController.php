<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mohfza;
use App\Models\Mantikqa;
use App\User;
use App\Models\Commercial_name;
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
        $mo7afza=request()->mo7afza;
        
        $manatek =Mantikqa::with('Tas3ir_3amil' ,'Tas3ir_ta7wel')->where('mo7afza',$mo7afza)->where('branch','الفرع الرئيسى')->get();

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
        
        $filtered_clients = User::where('type_','عميل')->where('name_',$client_id)->pluck('code_')->toArray();
        
        $Commercial_names =Commercial_name::whereIn('code_',$filtered_clients)->groupBy('name_')->get();

        return response()->json([
            'status' => 200,
            'message' => 'success',
            'all' => $Commercial_names,
            'sum' => count($Commercial_names),
        ], 200); 
        
    }

    
  
}
