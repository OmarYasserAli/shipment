<?php

namespace App\Http\Controllers\setting;

use App\Http\Controllers\Controller;
use App\User;
use App\Models\Mohfza;
use App\Models\BranchInfo;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class definationsController extends Controller
{
        public function company()
        {
        	return view('deffinations.company');
        }

        public function addCity()
        {
        	$cities=Mohfza::where('branch',auth()->user()->branch)->get();
        	return view('deffinations.city',compact('cities'));
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
                    BranchInfo::create($request->all());
                    return redirect()->back()->with('status', 'تم تسجيل الفرع');
        }

        public function addBranch()
        {
        	return view('deffinations.branch');
        }
}
