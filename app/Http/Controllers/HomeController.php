<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shipment;
use App\Models\Shipment_status;
use App\Setting;
use App\User;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       
        $dailyShipments = Shipment::where('date_'  ,'>=',DATE( Carbon::now()->format('Y-m-d')))->where('branch_',auth()->user()->branch)->get();
        $dailyStatus    = Shipment::where('tarikh_el7ala'  ,'>=',DATE( Carbon::now()->format('Y-m-d')))
        ->where('tarikh_el7ala'  ,'<=',DATE( Carbon::now()->addDay(1)->format('Y-m-d')))
        ->where('Ship_area_',auth()->user()->branch)->select('Status_', DB::raw('count(*) as total'))->groupBy('Status_')->get()->pluck('total','Status_')->toArray();
         //dd(( $dailyStatus));
         $status = Shipment_status::all()->pluck('name_','code_')->toArray();
         $status_color=Setting::whereIN('name',['status_6_color','status_1_color','status_2_color','status_3_color'
        ,'status_4_color','status_7_color','status_8_color','status_9_color','status_10_color'])->get()->keyBy('name')->pluck('val');

        $clients = User::where('type_','عميل')->where('branch', auth()->user()->branch)->get();
        //dd($status_color);
        $page_title='لوحة المواقبة';
        return view('home' ,compact('page_title','dailyStatus','dailyShipments','status','status_color','clients'));
    }

    public function getclientChartData(){
        $data    = Shipment::where('client_ID_',request()->client_id);
        if(isset(request()->date_from)){
            $data  = $data->where('date_','>=' ,request()->date_from);
        }
        if(isset(request()->date_to)){
            $data  = $data->where('date_','<=' ,request()->date_to);
        }
        //->where('Ship_area_',auth()->user()->branch)
        $data  = $data->select('Status_', DB::raw('count(*) as total'))->groupBy('Status_')->get()->pluck('total','Status_')->toArray();
        $status = Shipment_status::all()->pluck('name_','code_')->toArray();
        return response()->json([
            'status' => 200,
            'data' => $data,
            'statuses' => $status,
        ],200);
    }
    public function index2()
    {
        $page_title='لوحة المواقبة';
        return view('home' ,compact('page_title'));
    }
}
