<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mohfza;
use App\Models\Mantikqa;
use App\Models\O5ra_7sabat;
use App\Models\Masaref;
use App\Models\BranchInfo;


use App\User;
use App\Setting;


class SettingController extends Controller
{
    public function index()
    {

        $settings  =Setting::where('branch','all')->orwhere('branch',auth()->user()->branch)->get()->keyBy('name');
        //dd($settings);
        return view('setting.index', compact('settings'));
    }
    
    public function store(Request $request)
    {
        // $rules = Setting::getValidationRules();
        // dd('a');
        // $data = $this->validate($request, $rules);
        // $validSettings = array_keys($rules);
        if($request->shipment_code_ai =='on')
            Setting::add('shipment_code_ai', 1, Setting::getDataType('shipment_code_ai'));
        else
            Setting::add('shipment_code_ai', 0, Setting::getDataType('shipment_code_ai'));
        if($request->remove_mantka =='on')
            Setting::add('remove_mantka', 1, Setting::getDataType('remove_mantka'));
        else
            Setting::add('remove_mantka', 0, Setting::getDataType('remove_mantka'));
        if($request->remove_mo7fza =='on')
            Setting::add('remove_mo7fza', 1, Setting::getDataType('remove_mo7fza'));
        else
            Setting::add('remove_mo7fza', 0, Setting::getDataType('remove_mo7fza'));
        if($request->remove_client_name =='on')
            Setting::add('remove_client_name', 1, Setting::getDataType('remove_client_name'));
        else
            Setting::add('remove_client_name', 0, Setting::getDataType('remove_client_name'));
        if($request->remove_commercial_name =='on')
            Setting::add('remove_commercial_name', 1, Setting::getDataType('remove_commercial_name'));
        else
            Setting::add('remove_commercial_name', 0, Setting::getDataType('remove_commercial_name'));
        $br = auth()->user()->branch_;
        if($request->auto_sanad =='on'){
            $s = Setting::where('name','auto_sanad')->where('branch',auth()->user()->branch)->first();
            $s->val=1;  $s->save();
        }
        else{
            $s = Setting::where('name','auto_sanad')->where('branch',auth()->user()->branch)->first();
            $s->val=1;  $s->save();  
        }
            Setting::add('auto_sanad', 0, Setting::getDataType('auto_sanad'));   
        // dd($request->all());
        $data= $request->except(['_token','shipment_code_ai' ,'remove_mantka','remove_mo7fza','remove_client_name','remove_commercial_name','auto_sanad']);
        foreach ($data as $key => $val) {
            //if (in_array($key, $validSettings)) {
                Setting::add($key, $val, Setting::getDataType($key));
            //}
        }
    
        return redirect()->back()->with('status', 'تم الحفظ');
    }
    
    public function o5ra_tree(){
        $b = BranchInfo::where('name_',auth()->user()->branch)->first();
        $items =O5ra_7sabat::where('branch_id',$b->code_)->get();
        return view("setting.o5ra_tree" , compact('items'));
    }
    

    public function buildTree(array $elements, $parentId = 0) {
        $branch = array();

        foreach ($elements as  $key => $element) {
            if ($element['parent_id'] == $parentId) {
                $children = $this->buildTree($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }
        return( $branch);
    }


    public function masaref_tree(){
        $b = BranchInfo::where('name_',auth()->user()->branch)->first();
        $items =Masaref::where('branch_id',$b->code_)->orderBy('parent_id')->select('code_ as id','parent_id as parent_id','name_ as name')->get()->toArray();
        $tree=[];
        $tree = $this->buildTree($items);
        //dd($tree);
        return view("setting.masaref_tree" , compact('items','tree'));
    }
    public function masaref_tree_store(Request $request){
        // dd($request->all());

        $item = new Masaref();
        $item->name_= $request->name;
        $item->parent_id=$request->parent ;
        $b = BranchInfo::where('name_',auth()->user()->branch)->first();
        $item->branch_id= $b->code_ ;

        $item->save() ;

        return response()->json([
            'status' => 200,
           
        ], 200); 
    }

    public function o5ra_tree_store(Request $request){
        // dd($request->all());

        $item = new O5ra_7sabat();
        $item->name_= $request->name;
        $item->parent_id=$request->parent ;
        $b = BranchInfo::where('name_',auth()->user()->branch)->first();
        $item->branch_id= $b->code_ ;

        
        $item->save() ;

        return response()->json([
            'status' => 200,
           
        ], 200); 
    }
  
}
