<?php

namespace App\Http\Controllers\setting;

use App\Http\Controllers\Controller;
use App\Models\UserHistory;
use App\User;
use App\Models\Mohfza;
use App\Models\Mantikqa;

use App\Models\BranchInfo;
use App\Models\CompanyInfo;
use Illuminate\Support\Facades\Storage;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class definationsController extends Controller
{
            public function company()
            {
                    $user=auth()->user();
                    if(!$user->isAbleTo('companyDefinations-definations')){
                    return abort(403);
                    }
                    $page_title='تعريف الشركة';
                $company =CompanyInfo::where('branch_',Auth::user()->branch)->first() ;

            return view('deffinations.company',compact('page_title','company'));
            }
            public function storeCompany(Request $request){

                $img_path = null;


                    $company =CompanyInfo::where('branch_',Auth::user()->branch)->first() ;
                    $validated = $request->validate([
                        'name_' => 'required',
                        'name_E' => 'required',

                        'address_' => 'required',
                        'Tel_' => 'required',

                    ],[
                        'name_.required'=> 'اسم الفرع بالعربية مطلوب',
                        'name_E.required'=> 'اسم الفرع بالانجليزية مطلوب',
                        'address_.required'=> 'العنوان مطلوب',
                        'Tel_.required'=> 'الهاتف  مطلوب',
                        'logo.required'=> 'الصورة  مطلوب',

                    ]);

                    if($company){
                        // if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
                        //     $imag = $request->file('logo');
                        //     if ($company->image_data && file_get_contents('assets',$company->image_data)->exists($company->image_data)) {
                        //         $img_path = $imag->storeAs('/logo', basename($company->image_data), 'assets');
                        //     } else {
                        //         $img_path = $imag->store('/logo', 'assets');
                        //     }
                        // }
                        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
                            $img = $request->file('logo');
                            $img_path = $img->store('/logo', 'assets');
                        }
                        if($img_path == null && $company->image_data ){
                            $img_path = $company->image_data;
                        }

                        $company->update([
                            'name_'=>$request->name_,
                            'name_E'=>$request->name_E,
                            'address_'=>$request->address_,
                            'Tel_'=>$request->Tel_,
                            'notes_'=>$request->notes_,
                            'image_data' => strip_tags($img_path,'<img>')


                        ]);
                        UserHistory::create([
                            "user_id" => auth()->user()->code_,
                            "action_name" => "تعديل بيانات الشركة",
                            "action_desc" => "تعديل بيانات الشركة",
                            "branch" => auth()->user()->branch

                        ]);
                        return redirect()->back()->with('status', 'تم تعديل الشركة');

                    }else{
                        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
                            $img = $request->file('logo');
                            $img_path = $img->store('/logo', 'assets');
                        }
                        CompanyInfo::create([
                            'name_'=>$request->name_,
                            'name_E'=>$request->name_E,
                            'address_'=>$request->address_,
                            'Tel_'=>$request->Tel_,
                            'notes_'=>$request->notes_,
                            'branch_' => Auth::user()->branch,
                            'image_data' => $img_path
                        ]);
                        UserHistory::create([
                            "user_id" => auth()->user()->code_,
                            "action_name" => " انشاء شركة",
                            "action_desc" =>  "تم تسجيل الشركة",
                            "branch" => auth()->user()->branch

                        ]);
                        return redirect()->back()->with('status', 'تم تسجيل الشركة');
                    }
                }
        public function addCity()
        {
                $user=auth()->user();
                if(!$user->isAbleTo('addManatek-definations')){
                return abort(403);
                }
            $cities=Mohfza::where('branch',auth()->user()->branch)->get();
                $page_title='المناطق و المحافظات';
            return view('deffinations.city',compact('cities','page_title'));
        }
        public function storeCity(Request $request)
        {
            $validated = $request->validate([
                'name' => 'required',
            ]);
           $m = new Mohfza();   
           $m->name = $request->name;
           $m->USER = auth()->user()->name_;
           $m->branch =auth()->user()->branch;

           
           $m->save();
           UserHistory::create([
            "user_id" => auth()->user()->code_,
            "action_name" => " انشاء محافظة",
            "action_desc" =>  " تم انشاء محافظة جديدة" . $request->name ,
            "branch" => auth()->user()->branch

        ]);
           return response()->json([
            'success' => true,
            'message' => '',
        ]);           
        }

        public function storeMntka(Request $request)
        {
            $validated = $request->validate([
                'name' => 'required',
            ]);
           $m = new Mantikqa();   
           $m->name = $request->name;
           $m->USER = auth()->user()->name_;
           $m->branch =auth()->user()->branch;
           $m->mo7afza =$request->mo7afza;
           $m->code = Mantikqa::max('code')+1;
           
          
           $m->el3omola =0.00;

           
           $m->save();
           UserHistory::create([
            "user_id" => auth()->user()->code_,
            "action_name" => " انشاء منطقة",
            "action_desc" =>  " تم انشاء منطقة جديدة" . $request->name ,
            "branch" => auth()->user()->branch

        ]);
           return response()->json([
            'success' => true,
            'message' => '',
        ]);           
        }

        
        public function storeBranch(Request $request){
                // dd($request->all());
                $validated = $request->validate([
                        'name_' => 'required',
                        'name_E' => 'required',

                        'address_' => 'required',
                        'Tel_' => 'required',
                    ],[
                        'name_.required'=> 'اسم الفرع بالعربية مطلوب',
                        'name_E.required'=> 'اسم الفرع بالانجليزية مطلوب',
                        'address_.required'=> 'العنوان مطلوب',
                        'Tel_.required'=> 'الهاتف  مطلوب',

                    ]);
                    $br = BranchInfo::create($request->all());
                    $br->serial_ = $br->code_;
                    $br->save();
                     $br = CompanyInfo::create($request->all());
                    $br->code_ = $br->serial_;
                    $br->save();
                    
            UserHistory::create([
                "user_id" => auth()->user()->code_,
                "action_name" => " انشاء الفرع",
                "action_desc" =>  " تم انشاء فرع جديد" . $br->code_ ,
                "branch" => auth()->user()->branch

            ]);
                    return redirect()->back()->with('status', 'تم تسجيل الفرع');
        }

        public function addBranch()
        {
                $user=auth()->user();
                if(!$user->isAbleTo('addBranches-definations')){
                return abort(403);
                }
                $page_title='اضافة الفروع';
            return view('deffinations.branch',compact('page_title'));
        }
}
