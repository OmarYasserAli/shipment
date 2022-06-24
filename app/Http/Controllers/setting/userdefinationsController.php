<?php

namespace App\Http\Controllers\setting;

use App\Http\Controllers\Controller;
use App\User;
use App\Models\Mohfza;
use App\Models\Commercial_name;
use App\Models\BranchInfo;
use App\Models\AddClientsMainComp;
use App\Setting;
use App\Models\AddBranchUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class userdefinationsController extends Controller
{
        public function addClient()
        {
                $user=auth()->user();
                if(!$user->isAbleTo('add3amel-userDefinations')){
                        return abort(403);
                }
                $user=auth()->user();
                $mo7afazat =Mohfza::where('branch',$user->branch)->get();
                $Commercial_names =Commercial_name::groupBy('name_')->get();
                $branches = BranchInfo::all();
                $users =AddClientsMainComp::where('Branch_name',$user->branch)->get();
                $page_title='اضافة عميل';
         return view('users.addClient',compact('page_title','Commercial_names','mo7afazat','users','branches'));
        }
        public function storeClient(Request $request){

                $comerName = (explode(",",$request->Commercial_name));
                //dd($comerName);
               
                $validated = $request->validate([
                        "client_name" => 'required',
                        "Commercial_name" => 'required',
                        "username" => 'required',
                        "password" => 'required',
                        "ID_" => 'required',
                        "phone_" => 'required',
                        "address_" => 'required',
                        "mo7afza" => 'required',
                        "manteka" => 'required',
                        "Special_prices" => 'required',
                        "branch" => 'required'
                    ],[
                        'client_name.required'=> 'اسم العميل مطلوب',
                        'Commercial_name.required'=> 'الاسم التجارى مطلوب',
                        'username.required'=> 'اسم المستخدم مطلوب',
                        'password.required'=> 'الباسورد  مطلوب',
                        'ID_.required'=> 'رقم الهوية  مطلوب',
                        'phone_.required'=> 'الهاتف  مطلوب',
                        'address_.required'=> 'العنوان  مطلوب',
                        'mo7afza.required'=> 'المحافظة  مطلوبة',
                        'manteka.required'=> 'المنطقة  مطلوبة',
                        'Special_prices.required'=> 'السعر الخاص  مطلوب',
                        'branch.required' => 'الفرع مطلوب'

                    ]);
                    $mo7afzaa= Mohfza::where('code',$request->mo7afza)->first()->name;
                    $user=auth()->user();
                    $branch_name= BranchInfo::where('code_',$request->branch)->first()->name_;
                DB::beginTransaction();
                    $created_client = new AddClientsMainComp();
                    $created_client->name_  = $request->client_name  ;
                    $created_client->USERNAME  = $request->username  ;
                    $created_client->PASSWORD   = $request->password  ;
                    $created_client->ID_  = $request->ID_  ;
                    $created_client->address_  = $request->address_  ;
                    $created_client->commercial_name  = $request->Commercial_name  ;
                    $created_client->Branch_ID  =$request->branch ;
                    $created_client->Branch_name  = $branch_name  ;
                    $created_client->Special_prices  = $request->Special_prices  ;
                    $created_client->mo7fza  = $mo7afzaa  ;
                    $created_client->mantqa  = $request->manteka  ;
                    $created_client->phone_  = $request->phone_  ;
                //     $created_client->mantqa  = $request->mantqa  ;
                    $created_client->save();

                    $created_user = new user();
                    $created_user->name_  = $request-> client_name ;
                    $created_user->type_  = "عميل"  ;
                    $created_user->status_  = 0  ;
                    $created_user->branch  = $branch_name  ;
                    $created_user->username  = $request->username ;
                    $created_user->password       = $request->password  ;
                    $created_user->mo7fza  = $mo7afzaa  ;
                    $created_user->mantqa  = $request->manteka  ;
                    $created_user->phone_  = $request->phone_  ;
                    if($request->addshipment =='on'){
                        $created_user->addshipment  = 1  ;
                    }
                    

                    
                    $created_user->save();

                    foreach($comerName as $com){
                      if($com != ''){
                        DB::table('add_commercial_names_tb')->insert(
                                [
                                        'name'=> $com ,
                                        'branch'=> $request->branch ,
                                        'elmola7zat'=> ' ',
                                        'USER'=>$request-> client_name ,
                                        'GUID'=> ' ',
                                        'phone_'=> $request->phone_,
                                        
                                ]
                                );
                                DB::table('commercial_name_for_main_comp')->insert(
                                        [
                                                'name_'=> $com ,
                                                'code_client'=> $created_user->code_ ,
                                                'name_client'=> $request-> client_name ,
                                                'code_'=> $created_user->code_ ,
                                                
                                                
                                        ]
                                        );
                      }
        
        
        
        
                                        
                        }
                try {

                        DB::commit();
                } catch (\Exception $e) {
                        DB::rollback();
                }
                return redirect()->back()->with('status', 'تم تسجيل العميل');


        }
        public function editclient(int $code){
                $user=auth()->user();
                $mo7afazat =Mohfza::where('branch',$user->branch)->get();
                $Commercial_names =Commercial_name::groupBy('name_')->get();
                $user =AddClientsMainComp::where('code_',$code)->first();
                $page_title='تعديل عميل';
            $branches = BranchInfo::all();
         return view('users.editClient',compact('page_title','Commercial_names','mo7afazat','user','branches'));
        }
        public function updateClient(Request $request){
                $validated = $request->validate([
                        "code_" => 'required',
                        // "client_name" => 'required',
                        // "Commercial_name" => 'required',
                        // "username" => 'required',
                        // "password" => 'required',
                        // "ID_" => 'required',
                        // "phone_" => 'required',
                        // "address_" => 'required',
                        // "mo7afza" => 'required',
                        // "manteka" => 'required',
                        // "Special_prices" => 'required',
                    ]);
                    $mo7afzaa= Mohfza::where('code',$request->mo7afza)->first()->name;
                    $user=auth()->user();
                    $branch_id= BranchInfo::where('name_',$user->branch)->first()->code_;
                     $branch_name= BranchInfo::where('code_',$request->branch)->first()->name_;
                DB::beginTransaction();
                    $created_client =  AddClientsMainComp::where('code_' , $request->code_)->first();
                    $created_user =  user::where('name_',$created_client->name_)->where('username',$created_client->USERNAME)
                     ->where('password',$created_client->PASSWORD)->first();
                    $created_client->name_  = $request->client_name  ;
                    $created_client->USERNAME  = $request->username  ;
                    $created_client->PASSWORD   = $request->password  ;
                    $created_client->ID_  = $request->ID_  ;
                    $created_client->address_  = $request->address_  ;
                    $created_client->commercial_name  = $request->Commercial_name  ;
                    $created_client->Branch_ID  =$request->branch ;
                    $created_client->Branch_name  = $branch_name  ;
                    $created_client->Special_prices  = $request->Special_prices  ;
                    $created_client->mo7fza  = $mo7afzaa  ;
                    $created_client->mantqa  = $request->manteka  ;
                    $created_client->phone_  = $request->phone_  ;
                //     $created_client->mantqa  = $request->mantqa  ;
                    $created_client->save();


                    $created_user->name_  = $request-> client_name ;
                    $created_user->type_  = "عميل"  ;
                    //$created_user->status_  = 1  ;
                    $created_user->branch  = $branch_name  ;
                    $created_user->username  = $request->username ;
                    $created_user->password       = $request->password  ;
                    $created_user->mo7fza  = $mo7afzaa  ;
                    $created_user->mantqa  = $request->manteka  ;
                    $created_user->phone_  = $request->phone_  ;
                    if($request->addshipment =='on'){
                        $created_user->addshipment  = 1  ;
                    }else{
                        $created_user->addshipment  = 0  ;
                    }
                    $created_user->save();
                try {

                        DB::commit();
                } catch (\Exception $e) {
                        DB::rollback();
                }
                return redirect()->back()->with('status', 'تم تسجيل العميل');
        }
        public function addMandoub()
        {
                $user=auth()->user();
                if(!$user->isAbleTo('addmandoub-userDefinations')){
                        return abort(403);
                }
                $mo7afazat =Mohfza::where('branch',$user->branch)->get();
                $Commercial_names =Commercial_name::groupBy('name_')->get();
                $manadeeb =AddBranchUser::where('branch_name',$user->branch)->where('Job','مندوب تسليم')->orWhere('Job','مندوب استلام')->get();

                $page_title='اضافة مندوب';
            $branches = BranchInfo::all();
         return view('users.addMandoub',compact('page_title','Commercial_names','mo7afazat','manadeeb','branches'));
        }
        public function storeMandoub(Request $request){
                $validated = $request->validate([
                        "mandoub_name" => 'required',
                        "job" => 'required',

                        "username" => 'required',
                        "password" => 'required',
                        "ID_" => 'required',
                       "phone_"=>'required',
                        "address_" => 'required',
                        "mo7afza" => 'required',
                        "manteka" => 'required',
                    "branch" => 'required'
                    ],[
                        'mandoub_name.required'=> 'اسم المندوب مطلوب',

                        'job.required'=> 'الوظيفة مطلوبة',
                        'username.required'=> 'اسم المستخدم مطلوب',
                        'password.required'=> 'الباسورد  مطلوب',
                        'ID_.required'=> 'رقم الهوية  مطلوب',
                        'phone_.required'=> 'الهاتف  مطلوب',
                         'branch.required' => 'الفرع مطلوب',
                        'address_.required'=> 'العنوان  مطلوب',
                        'mo7afza.required'=> 'المحافظة  مطلوبة',
                        'manteka.required'=> 'المنطقة  مطلوبة',


                    ]);
                    $user=auth()->user();
                    $mo7afzaa= Mohfza::where('code',$request->mo7afza)->first()->name;
                    $branch_id= BranchInfo::where('name_',$user->branch)->first()->code_;
                    $branch_name= BranchInfo::where('code_',$request->branch)->first()->name_;
                DB::beginTransaction();
                    $created_client = new AddBranchUser();
                    $created_client->name_  = $request->mandoub_name  ;
                    $created_client->USERNAME  = $request->username  ;
                    $created_client->PASSWORD   = $request->password  ;
                    $created_client->ID_  = $request->ID_  ;
                    $created_client->address_  = $request->address_  ;
                //     $created_client->commercial_name  = $request->Commercial_name  ;
                    $created_client->Job  =$request->job ;
                    $created_client->branch_name  = $branch_name  ;
                     $created_client->transport_kind  = ''  ;
                    $created_client->mo7fza  = $mo7afzaa  ;
                    $created_client->mantqa  = $request->manteka  ;
                    $created_client->notes  = $request->notes  ;
                    $created_client->phone_  = $request->phone_  ;
                    $created_client->save();

                    $created_user = new user();
                    $created_user->name_  = $request-> mandoub_name ;
                    $created_user->type_  = $request->job ;
                    $created_user->status_  = 0  ;
                    $created_user->branch  = $branch_name  ;
                    $created_user->username  = $request->username ;
                    $created_user->password       = $request->password  ;
                    $created_user->mo7fza  = $mo7afzaa  ;
                    $created_user->mantqa  = $request->manteka  ;
                //     $created_user->phone_  = ''  ;
                    $created_user->phone_  = $request->phone_  ;
                    $created_user->save();
                try {

                        DB::commit();
                } catch (\Exception $e) {
                        DB::rollback();
                }
                return redirect()->back()->with('status', 'تم تسجيل المندوب');
        }
        public function editMandoub(int $code)
        {
                $user=auth()->user();
                $mo7afazat =Mohfza::where('branch',$user->branch)->get();
                $Commercial_names =Commercial_name::groupBy('name_')->get();
                $manadoub =AddBranchUser::where('code_',$code)->first();
                // dd($manadoub);
                $branches = BranchInfo::all();
                $page_title='تعديل مندوب';
         return view('users.editMandoub',compact('page_title','branches','Commercial_names','mo7afazat','manadoub'));
        }
        public function updateMandoub(Request $request){
                $validated = $request->validate([
                        "code_" => 'required',
                //         "job" => 'required',

                //         "username" => 'required',
                //         "password" => 'required',
                //         "ID_" => 'required',
                //        "phone_"=>'required',
                //         "address_" => 'required',
                //         "mo7afza" => 'required',
                //         "manteka" => 'required',

                ]);
                $user=auth()->user();
                    $mo7afzaa= Mohfza::where('code',$request->mo7afza)->first()->name;
                    $branch_id= BranchInfo::where('name_',$user->branch)->first()->code_;
                    $branch_name= BranchInfo::where('code_',$request->branch)->first()->name_;
                DB::beginTransaction();
                    $created_client =  AddBranchUser::where('code_',$request->code_)->first();
                    $created_user =  user::where('name_',$created_client->name_)->where('username',$created_client->USERNAME) ->where('password',$created_client->PASSWORD)->first();
                    if($created_user == null){
                        return redirect()->back()->with('status', 'خطأ: لم يتم العثور على المستخدم');
                    }
                    $created_client->name_  = $request->mandoub_name  ;
                    $created_client->USERNAME  = $request->username  ;
                    $created_client->PASSWORD   = $request->password  ;
                    $created_client->ID_  = $request->ID_  ;
                    $created_client->address_  = $request->address_  ;
                    $created_client->Job  =$request->job ;
                //     $created_client->commercial_name  = $request->Commercial_name  ;
                    $created_client->branch_name  = $branch_name  ;
                     $created_client->transport_kind  = ''  ;
                    $created_client->mo7fza  = $mo7afzaa  ;
                    $created_client->mantqa  = $request->manteka  ;
                    $created_client->notes  = $request->notes  ;
                    $created_client->phone_  = ''  ;
                    $created_client->save();


                    $created_user->name_  = $request-> mandoub_name ;
                    $created_user->type_  = $request->job ;
                    //$created_user->status_  = 0  ;
                    $created_user->branch  = $branch_name;
                    $created_user->username  = $request->username ;
                    $created_user->password       = $request->password  ;
                    $created_user->mo7fza  = $mo7afzaa  ;
                    $created_user->mantqa  = $request->manteka  ;
                    $created_user->phone_  = ''  ;
                //     $created_user->phone_  = ''  ;
                    $created_user->save();
                try {

                        DB::commit();
                } catch (\Exception $e) {
                        DB::rollback();
                }
                return redirect()->back()->with('status', 'تم تسجيل التعديلات');
        }
        public function adduser()
        {
                $user=auth()->user();
                if(!$user->isAbleTo('adduser-userDefinations')){
                        return abort(403);
                }
                $mo7afazat =Mohfza::where('branch',$user->branch)->get();
                $Commercial_names =Commercial_name::groupBy('name_')->get();
                $users =AddBranchUser::where('branch_name',$user->branch)->where('Job','موظف')->get();
            $branches = BranchInfo::all();
                $page_title='اضافة مستخدم';
         return view('users.adduser',compact('page_title','Commercial_names','mo7afazat','users','branches'));
        }
        public function storeUser(Request $request){
                $validated = $request->validate([
                        "mandoub_name" => 'required',

                    "branch" => 'required',
                        "username" => 'required',
                        "password" => 'required',
                        "ID_" => 'required',
                       //"phone_"=>'required',
                        "address_" => 'required',
                        "mo7afza" => 'required',
                        "manteka" => 'required',

                    ],[
                        'mandoub_name.required'=> 'اسم المندوب مطلوب',
                        'branch.required' => 'الفرع مطلوب',
                        'username.required'=> 'اسم المستخدم مطلوب',
                        'password.required'=> 'الباسورد  مطلوب',
                        'ID_.required'=> 'رقم الهوية  مطلوب',
                        //'phone_.required'=> 'الهاتف  مطلوب',

                        'address_.required'=> 'العنوان  مطلوب',
                        'mo7afza.required'=> 'المحافظة  مطلوبة',
                        'manteka.required'=> 'المنطقة  مطلوبة',


                    ]);
                    $user=auth()->user();
                    $mo7afzaa= Mohfza::where('code',$request->mo7afza)->first()->name;
                    $branch_id= BranchInfo::where('name_',$user->branch)->first()->code_;
                    $branch_name= BranchInfo::where('code_',$request->branch)->first()->name_;
                DB::beginTransaction();
                    $created_client = new AddBranchUser();
                    $created_client->name_  = $request->mandoub_name  ;
                    $created_client->USERNAME  = $request->username  ;
                    $created_client->PASSWORD   = $request->password  ;
                    $created_client->ID_  = $request->ID_  ;
                    $created_client->address_  = $request->address_  ;
                //     $created_client->commercial_name  = $request->Commercial_name  ;
                    $created_client->Job  ='موظف';
                    $created_client->branch_name  = $branch_name  ;
                     $created_client->transport_kind  = ''  ;
                    $created_client->mo7fza  = $mo7afzaa  ;
                    $created_client->mantqa  = $request->manteka  ;
                    $created_client->notes  = $request->notes  ;
                    $created_client->phone_  = ''  ;
                    $created_client->save();

                    $created_user = new user();
                    $created_user->name_  = $request-> mandoub_name ;
                    $created_user->type_  =  'موظف';
                    $created_user->status_  = 1  ;
                    $created_user->branch  = $branch_name  ;
                    $created_user->username  = $request->username ;
                    $created_user->password       = $request->password  ;
                    $created_user->mo7fza  = $mo7afzaa  ;
                    $created_user->mantqa  = $request->manteka  ;
                    $created_user->phone_  = ''  ;
                //     $created_user->phone_  = ''  ;
                    $created_user->save();
                try {

                        DB::commit();
                } catch (\Exception $e) {
                        DB::rollback();
                }
                return redirect()->back()->with('status', 'تم تسجيل المندوب');
        }
        public function editUser(int $code)
        {
                $user=auth()->user();
                $mo7afazat =Mohfza::where('branch',$user->branch)->get();
                $Commercial_names =Commercial_name::groupBy('name_')->get();
                $manadoub =AddBranchUser::where('code_',$code)->first();
                // dd($manadoub);
                $branches = BranchInfo::all();
                $page_title='تعديل مستخدم';
         return view('users.editUser',compact('page_title','branches','Commercial_names','mo7afazat','manadoub'));
        }
        public function updateUser(Request $request){
                $validated = $request->validate([
                        "code_" => 'required',
                //         "job" => 'required',

                //         "username" => 'required',
                //         "password" => 'required',
                //         "ID_" => 'required',
                //        "phone_"=>'required',
                //         "address_" => 'required',
                //         "mo7afza" => 'required',
                //         "manteka" => 'required',

                ]);
                $user=auth()->user();
                    $mo7afzaa= Mohfza::where('code',$request->mo7afza)->first()->name;
                    $branch_id= BranchInfo::where('name_',$user->branch)->first()->code_;
            $branch_name= BranchInfo::where('code_',$request->branch)->first()->name_;
                DB::beginTransaction();
                    $created_client =  AddBranchUser::where('code_',$request->code_)->first();
                    $created_user =  user::where('name_',$created_client->name_)->where('username',$created_client->USERNAME) ->where('password',$created_client->PASSWORD)->first();
                    if($created_user == null){
                        return redirect()->back()->with('status', 'خطأ: لم يتم العثور على المستخدم');
                    }
                    $created_client->name_  = $request->mandoub_name  ;
                    $created_client->USERNAME  = $request->username  ;
                    $created_client->PASSWORD   = $request->password  ;
                    $created_client->ID_  = $request->ID_  ;
                    $created_client->address_  = $request->address_  ;
                //     $created_client->commercial_name  = $request->Commercial_name  ;
                    $created_client->Job  ='موظف';
                    $created_client->branch_name  = $branch_name  ;
                     $created_client->transport_kind  = ''  ;
                    $created_client->mo7fza  = $mo7afzaa  ;
                    $created_client->mantqa  = $request->manteka  ;
                    $created_client->notes  = $request->notes  ;
                    $created_client->phone_  = ''  ;
                    $created_client->save();


                    $created_user->name_  = $request-> mandoub_name ;
                    $created_user->type_  =  'موظف';
                    //$created_user->status_  = 1  ;
                    $created_user->branch  = $branch_name  ;
                    $created_user->username  = $request->username ;
                    $created_user->password       = $request->password  ;
                    $created_user->mo7fza  = $mo7afzaa  ;
                    $created_user->mantqa  = $request->manteka  ;
                    $created_user->phone_  = ''  ;
                //     $created_user->phone_  = ''  ;
                    $created_user->save();
                try {

                        DB::commit();
                } catch (\Exception $e) {
                        DB::rollback();
                }
                return redirect()->back()->with('status', 'تم تسجيل التعديلات');

        }
        public function registrationRequest(Request $request)
        { 
                
                $user=auth()->user();
                if(!$user->isAbleTo('registrationRequest-userDefinations')){
                        return abort(403); 
                }
                $limit=Setting::get('items_per_page');
                $page =0;
                if(isset(request()->page)) $page= request()->page;

                $shipments = User::where('status_',0)->where('branch',$user->branch);
                if(isset($request->branch)){
                $shipments = $shipments->where(function ($query) use($request){
                        $query->where('branch_', '=', $request->branch)
                        ->orWhere('transfere_1', '=', $request->branch);
                });        
                }
                if(isset($request->mo7afza)){
                $shipments = $shipments->where('mo7afaza_id', '=', $request->mo7afza);       
                }

                $all_shipments = $shipments;

                
                
                if(request()->showAll == 'on'){
                $counter= $all_shipments->get();
                $count_all = $counter->count();
                request()->limit=$count_all;
                }
                //  dd($all_shipments->skip(0)->limit(40)->get()[20]);
             
                $all = $all_shipments->skip($limit*$page)->limit($limit)->get();
                if(isset(request()->lodaMore)){
                
                return response()->json([
                        'status' => 200,
                        'data' => $all,
                        'message' => 'sucecss',
                        'sums'=>$sums
                ], 200);
                }
                
                $page_title='الموافقة على  طلبات التسجيل';
                $branches =BranchInfo::all();
                $mo7afazat =Mohfza::all();
                return view('users.registrationRequest',compact('all','branches','mo7afazat'));
        
        }
        public function registrationRequestSave (Request $request){
               
                $u = User::where('code_',$request->code)->first();
                if(!isset($u)){
                        return response()->json([
                                'status' => 404,
                                'message' => 'fail',
                                
                        ], 404);
                }
                if($request->type=='accept'){
                        $u->status_ =1;
                }
                elseif($request->type=='cancel'){
                        $u->status_ =2;
                }else{
                        return response()->json([
                                'status' => 404,
                                'message' => 'fail',
                                
                        ], 404);
                }
                $u->save();

                return response()->json([
                        'status' => 200,
                        'message' => 'sucecss',
                        
                ], 200);
        }
        public function commercialNames()
        {
                $user=auth()->user();
                if(!$user->isAbleTo('commertialName-userDefinations')){
                        return abort(403); 
                }
        	return view('users.commercialNames');
        }

        
}
