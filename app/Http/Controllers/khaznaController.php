<?php

namespace App\Http\Controllers;

use App\CustomClass\response;
use App\Http\Controllers\Api\site\Controller;
use App\Models\BranchInfo;
use App\Models\Mantikqa;
use App\Models\Mohfza;
use App\Models\Shipment;
use App\Models\AllUser;
use App\Models\Shipment_status;
use App\Models\Commercial_name;
use App\Models\Archive;
use App\User;
use App\Models\Khazna;
use App\Models\Branch_user;
use QrCode;

use Carbon\Carbon;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use PDF;
class khaznaController extends Controller
{
    public function create(){
        $branches = BranchInfo::all();
        $page_title='اضافة خزنة';
        return view( 'setting.khazna',compact('branches','page_title'));
    }
    public function store(Request $request){

        $validated = $request->validate([
            //'reciver_name_' => 'required',
            'name' => 'required|unique:5azna',
            'branch_id' => 'required',

        ]);
        Khazna::create($request->all());
        return back()->with(['status' => 'تم اضافة الخزنة بنجاح']);
    }
    public function addUserTo5azma(Request $request){
        $users = User::where('type_','موظف')->get();
        $khaznat = Khazna::all();
        $attachedTo = [];
        if(isset($request->client_id))
            $attachedTo= user::where('code_',$request->client_id)->first()->khazna->pluck('id')->toArray();
            //dd($attachedTo);
        return view('setting.addUser5azna' ,compact('users', 'khaznat','attachedTo'));
    }
    public function addUserTo5azma_save(Request $request){
        // dd($request->all());

        $user = User::where('code_' ,$request->user_id)->first();
        $user->Khazna()->sync($request->khazna_ids);
    }
}
