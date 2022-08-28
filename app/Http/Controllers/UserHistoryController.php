<?php

namespace App\Http\Controllers;

use App\Models\UserHistory;
use Illuminate\Http\Request;

class UserHistoryController extends Controller
{
    public function index(){
        $users = UserHistory::orderby('id','DESC')->get();
        return view("history.userHistory",compact("users"));
    }
}
