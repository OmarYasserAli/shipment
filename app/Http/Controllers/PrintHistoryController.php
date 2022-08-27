<?php

namespace App\Http\Controllers;

use App\Models\Print_report;
use Illuminate\Http\Request;

class PrintHistoryController extends Controller
{
    public function index(){
        $prints = Print_report::get();
        return view("history.printHistory",compact("prints"));
    }
}
