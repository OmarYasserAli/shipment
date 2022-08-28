<?php

namespace App\Http\Controllers;

use App\Models\UserHistory;
use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
class UserHistoryController extends Controller
{
    public function index(){
        $user=auth()->user();
        $history = UserHistory::orderby('id','DESC');
        
        if(isset(request()->user_id)){
            $history =  $history->where('user_id',request()->user_id);
        }
        if(isset(request()->date_from)){
            $history =  $history->where('created_at', '>='  ,request()->date_from);
        }
        if(isset(request()->date_to)){
            $date_to =  new Carbon(request()->date_to);
            $date_to =  $date_to ->addDays(1)->format('y-m-d');
            $history =  $history->where('created_at', '<=' ,request()->date_to);
        }

        $history= $history->get();
        $page_title='حركة الموقع';
        $moazafeen = User::where('type_','موظف')->where('branch', $user->branch)->get();
        return view("history.userHistory",compact("history",'page_title','moazafeen'));
    }
}
