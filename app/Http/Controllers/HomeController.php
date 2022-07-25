<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shipment;
use Carbon\Carbon;
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
       
        $dailyShipments = Shipment::where('date_'  ,'>=',DATE( Carbon::now()->format('Y-m-d')))->get();
        $dailyStatus    = Shipment::where('tarikh_el7ala'  ,'>=',DATE( Carbon::now()->format('Y-m-d')))->get();
        dd(( $dailyStatus));
        $page_title='لوحة المواقبة';
        return view('home' ,compact('page_title'));
    }
    public function index2()
    {
        $page_title='لوحة المواقبة';
        return view('home' ,compact('page_title'));
    }
}
