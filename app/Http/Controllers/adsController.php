<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shipment;
use App\Models\Shipment_status;
use App\Setting;
use App\Ad;
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

    public function index(){
        
    }
    public function create(){
        
    }
    public function store(){
        
    }
    public function edit(){
        
    }
    public function update(){
        
    }

}
