<?php

namespace App\Http\Controllers;

use App\Models\UserHistory;
use Illuminate\Http\Request;
use App\Models\Mohfza;
use App\Models\Mantikqa;
use App\User;
use App\Models\Commercial_name;
use App\Models\Tas3ir_3amil;


use App\Models\AddClientsMainComp;
use Illuminate\Support\Facades\DB;

class chatController extends Controller
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

    public function index(){
        
    }

}
