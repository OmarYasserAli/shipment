<?php

namespace App\Http\Controllers\setting;

use App\Http\Controllers\Controller;
use App\User;
use App\Models\Mohfza;
use App\Models\Commercial_name;
use App\Models\BranchInfo;
use App\Models\AddClientsMainComp;
;
use App\Models\AddBranchUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class userdefinationsController extends Controller
{
        public function addClient()
        {
                $user=auth()->user();
                $mo7afazat =Mohfza::where('branch',$user->branch)->get();
                $Commercial_names =Commercial_name::groupBy('name_')->get();
                $users =AddClientsMainComp::all();
                $page_title='اضافة عميل';
        	return view('users.addClient',compact('page_title','Commercial_names','mo7afazat','users'));
        }
        public function storeClient(Request $request){
                //dd($request->all());
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
                        
                    ]);
                    $mo7afzaa= Mohfza::where('code',$request->mo7afza)->first()->name;
                    $user=auth()->user();
                    $branch_id= BranchInfo::where('name_',$user->branch)->first()->code_;
                DB::beginTransaction();
                    $created_client = new AddClientsMainComp();
                    $created_client->name_  = $request->client_name  ;
                    $created_client->USERNAME  = $request->username  ;
                    $created_client->PASSWORD	  = $request->password  ;
                    $created_client->ID_  = $request->ID_  ;
                    $created_client->address_  = $request->address_  ;
                    $created_client->commercial_name  = $request->Commercial_name  ;
                    $created_client->Branch_ID  =$branch_id ;
                    $created_client->Branch_name  = $user->branch  ;
                    $created_client->Special_prices  = $request->Special_prices  ;
                    $created_client->mo7fza  = $mo7afzaa  ;
                    $created_client->mantqa  = $request->manteka  ;
                    $created_client->phone_  = $request->phone_  ;
                //     $created_client->mantqa  = $request->mantqa  ;
                    $created_client->save();

                    $created_user = new user();
                    $created_user->name_  = $request-> client_name ;
                    $created_user->type_  = "عميل"  ;
                    $created_user->status_  = 1  ;
                    $created_user->branch  = $user->branch  ;
                    $created_user->username  = $request->username ;
                    $created_user->password       = $request->password  ;
                    $created_user->mo7fza  = $mo7afzaa  ;
                    $created_user->mantqa  = $request->manteka  ;
                    $created_user->phone_  = $request->phone_  ;
                    $created_user->save();
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
        	return view('users.editClient',compact('page_title','Commercial_names','mo7afazat','user'));
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
                DB::beginTransaction();
                    $created_client =  AddClientsMainComp::where('code_' , $request->code_)->first();
                    $created_user =  user::where('name_',$created_client->name_)->where('username',$created_client->USERNAME)
                     ->where('password',$created_client->PASSWORD)->first();
                    $created_client->name_  = $request->client_name  ;
                    $created_client->USERNAME  = $request->username  ;
                    $created_client->PASSWORD	  = $request->password  ;
                    $created_client->ID_  = $request->ID_  ;
                    $created_client->address_  = $request->address_  ;
                    $created_client->commercial_name  = $request->Commercial_name  ;
                    $created_client->Branch_ID  =$branch_id ;
                    $created_client->Branch_name  = $user->branch  ;
                    $created_client->Special_prices  = $request->Special_prices  ;
                    $created_client->mo7fza  = $mo7afzaa  ;
                    $created_client->mantqa  = $request->manteka  ;
                    $created_client->phone_  = $request->phone_  ;
                //     $created_client->mantqa  = $request->mantqa  ;
                    $created_client->save();

                    
                    $created_user->name_  = $request-> client_name ;
                    $created_user->type_  = "عميل"  ;
                    $created_user->status_  = 1  ;
                    $created_user->branch  = $user->branch  ;
                    $created_user->username  = $request->username ;
                    $created_user->password       = $request->password  ;
                    $created_user->mo7fza  = $mo7afzaa  ;
                    $created_user->mantqa  = $request->manteka  ;
                    $created_user->phone_  = $request->phone_  ;
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
                $mo7afazat =Mohfza::where('branch',$user->branch)->get();
                $Commercial_names =Commercial_name::groupBy('name_')->get();
                $manadeeb =AddBranchUser::where('Job','مندوب تسليم')->orWhere('Job','مندوب استلام')->get();
                $page_title='اضافة مندوب';
        	return view('users.addMandoub',compact('page_title','Commercial_names','mo7afazat','manadeeb'));
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
                        
                    ],[
                        'mandoub_name.required'=> 'اسم المندوب مطلوب',
                        
                        'job.required'=> 'الوظيفة مطلوبة',
                        'username.required'=> 'اسم المستخدم مطلوب',
                        'password.required'=> 'الباسورد  مطلوب',
                        'ID_.required'=> 'رقم الهوية  مطلوب',
                        'phone_.required'=> 'الهاتف  مطلوب',
                        
                        'address_.required'=> 'العنوان  مطلوب',
                        'mo7afza.required'=> 'المحافظة  مطلوبة',
                        'manteka.required'=> 'المنطقة  مطلوبة',
                       
                        
                    ]);
                    $user=auth()->user();
                    $mo7afzaa= Mohfza::where('code',$request->mo7afza)->first()->name;
                    $branch_id= BranchInfo::where('name_',$user->branch)->first()->code_;
                DB::beginTransaction();
                    $created_client = new AddBranchUser();
                    $created_client->name_  = $request->mandoub_name  ;
                    $created_client->USERNAME  = $request->username  ;
                    $created_client->PASSWORD	  = $request->password  ;
                    $created_client->ID_  = $request->ID_  ;
                    $created_client->address_  = $request->address_  ;
                //     $created_client->commercial_name  = $request->Commercial_name  ;
                    $created_client->Job  =$request->job ;
                    $created_client->branch_name  = $user->branch  ;
                     $created_client->transport_kind  = ''  ;
                    $created_client->mo7fza  = $mo7afzaa  ;
                    $created_client->mantqa  = $request->manteka  ;
                    $created_client->notes  = $request->notes  ;
                    $created_client->phone_  = $request->phone_  ;
                    $created_client->save();

                    $created_user = new user();
                    $created_user->name_  = $request-> mandoub_name ;
                    $created_user->type_  = $request->job ;
                    $created_user->status_  = 1  ;
                    $created_user->branch  = $user->branch  ;
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
                $page_title='تعديل مندوب';
        	return view('users.editMandoub',compact('page_title','Commercial_names','mo7afazat','manadoub'));
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
                DB::beginTransaction();
                    $created_client =  AddBranchUser::where('code_',$request->code_)->first();
                    $created_user =  user::where('name_',$created_client->name_)->where('username',$created_client->USERNAME) ->where('password',$created_client->PASSWORD)->first();
                    if($created_user == null){
                        return redirect()->back()->with('status', 'خطأ: لم يتم العثور على المستخدم');
                    }
                    $created_client->name_  = $request->mandoub_name  ;
                    $created_client->USERNAME  = $request->username  ;
                    $created_client->PASSWORD	  = $request->password  ;
                    $created_client->ID_  = $request->ID_  ;
                    $created_client->address_  = $request->address_  ;
                    $created_client->Job  =$request->job ;
                //     $created_client->commercial_name  = $request->Commercial_name  ;
                    $created_client->branch_name  = $user->branch  ;
                     $created_client->transport_kind  = ''  ;
                    $created_client->mo7fza  = $mo7afzaa  ;
                    $created_client->mantqa  = $request->manteka  ;
                    $created_client->notes  = $request->notes  ;
                    $created_client->phone_  = ''  ;
                    $created_client->save();

                    
                    $created_user->name_  = $request-> mandoub_name ;
                    $created_user->type_  = $request->job ;
                    $created_user->status_  = 1  ;
                    $created_user->branch  = $user->branch  ;
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
                $mo7afazat =Mohfza::where('branch',$user->branch)->get();
                $Commercial_names =Commercial_name::groupBy('name_')->get();
                $users =AddBranchUser::where('Job','موظف')->get();
                $page_title='اضافة مستخدم';
        	return view('users.adduser',compact('page_title','Commercial_names','mo7afazat','users'));
        }

        public function storeUser(Request $request){
                $validated = $request->validate([
                        "mandoub_name" => 'required',
                        
                        
                        "username" => 'required',
                        "password" => 'required',
                        "ID_" => 'required',
                       //"phone_"=>'required',
                        "address_" => 'required',
                        "mo7afza" => 'required',
                        "manteka" => 'required',
                        
                    ],[
                        'mandoub_name.required'=> 'اسم المندوب مطلوب',
                        
                        
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
                DB::beginTransaction();
                    $created_client = new AddBranchUser();
                    $created_client->name_  = $request->mandoub_name  ;
                    $created_client->USERNAME  = $request->username  ;
                    $created_client->PASSWORD	  = $request->password  ;
                    $created_client->ID_  = $request->ID_  ;
                    $created_client->address_  = $request->address_  ;
                //     $created_client->commercial_name  = $request->Commercial_name  ;
                    $created_client->Job  ='موظف';
                    $created_client->branch_name  = $user->branch  ;
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
                    $created_user->branch  = $user->branch  ;
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
                $page_title='تعديل مستخدم';
        	return view('users.editUser',compact('page_title','Commercial_names','mo7afazat','manadoub'));
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
                DB::beginTransaction();
                    $created_client =  AddBranchUser::where('code_',$request->code_)->first();
                    $created_user =  user::where('name_',$created_client->name_)->where('username',$created_client->USERNAME) ->where('password',$created_client->PASSWORD)->first();
                    if($created_user == null){
                        return redirect()->back()->with('status', 'خطأ: لم يتم العثور على المستخدم');
                    }
                    $created_client->name_  = $request->mandoub_name  ;
                    $created_client->USERNAME  = $request->username  ;
                    $created_client->PASSWORD	  = $request->password  ;
                    $created_client->ID_  = $request->ID_  ;
                    $created_client->address_  = $request->address_  ;
                //     $created_client->commercial_name  = $request->Commercial_name  ;
                    $created_client->Job  ='موظف';
                    $created_client->branch_name  = $user->branch  ;
                     $created_client->transport_kind  = ''  ;
                    $created_client->mo7fza  = $mo7afzaa  ;
                    $created_client->mantqa  = $request->manteka  ;
                    $created_client->notes  = $request->notes  ;
                    $created_client->phone_  = ''  ;
                    $created_client->save();

                    
                    $created_user->name_  = $request-> mandoub_name ;
                    $created_user->type_  =  'موظف';
                    $created_user->status_  = 1  ;
                    $created_user->branch  = $user->branch  ;
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
        public function registrationRequest()
        {
        	return view('users.registrationRequest');
        }
        public function commercialNames()
        {
        	return view('users.commercialNames');
        }

        
}
