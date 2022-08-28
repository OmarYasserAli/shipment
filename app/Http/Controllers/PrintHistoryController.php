<?php

namespace App\Http\Controllers;

use App\Models\Print_report;
use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
class PrintHistoryController extends Controller
{
    public function index(){
       
        $user=auth()->user();
        $prints = Print_report::orderby('id','DESC');
        if(isset(request()->user_id)){
            $prints =  $prints->where('user_id',request()->user_id);
        }
        if(isset(request()->date_from)){
            $prints =  $prints->where('created_at', '>='  ,request()->date_from);
        }
        if(isset(request()->date_to)){
            $date_to =  new Carbon(request()->date_to);
            $date_to =  $date_to ->addDays(1)->format('y-m-d');
            $prints =  $prints->where('created_at', '<=' ,request()->date_to);
        }

        $prints= $prints->get();
        $page_title='حركة الطباعة';
        $moazafeen = User::where('type_','موظف')->where('branch', $user->branch)->get();
        return view("history.printHistory",compact("prints",'page_title','moazafeen'));
    }
}
