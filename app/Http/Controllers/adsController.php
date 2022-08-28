<?php

namespace App\Http\Controllers;

use App\Models\UserHistory;
use Illuminate\Http\Request;
use App\Models\Shipment;
use App\Models\Shipment_status;
use App\Setting;
use App\Models\Ad;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class adsController extends Controller
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

    $ads = Ad::all();
    return view("setting.ads.index",compact('ads'));

    }
    public function create(){
        return view("setting.ads.create");
    }
    public function store(Request $request){

        $validated = $request->validate([
            'name' => 'required',
            'ads' => 'required'

        ],[
            'name.required'=> 'الاسم مطلوب يرجى ادخاله',
            'ads.required'=> 'صورة مطلوبة',


        ]);
        if ($request->hasFile('ads') && $request->file('ads')->isValid()) {
            $img = $request->file('ads');
            $img_path = $img->store('/ads', 'assets');
        }
        Ad::create([
            'name'=>$request->name,
            'link' =>  asset('assets/'.$img_path)
        ]);
        UserHistory::create([
            "user_id" => auth()->user()->code_,
            "action_name" => " انشاء اعلان",
            "action_desc" =>  "تم انشاء اعلان",
        ]);
        return redirect()->back()->with('status', 'تم تسجيل الاعلان');

    }
    public function edit(){

    }
    public function update(){

    }

}
