<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mohfza;
use App\Models\Mantikqa;
use App\User;
use App\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $settings  =Setting::getAllSettings()->keyBy('name');
        return view('setting.index', compact('settings'));
    }
    
    public function store(Request $request)
    {
        // $rules = Setting::getValidationRules();
        // dd('a');
        // $data = $this->validate($request, $rules);
        // $validSettings = array_keys($rules);
       $data= $request->except(['_token']);
        foreach ($data as $key => $val) {
            //if (in_array($key, $validSettings)) {
                Setting::add($key, $val, Setting::getDataType($key));
            //}
        }
    
        return redirect()->back()->with('status', 'Settings has been saved.');
    }
    
  
}
