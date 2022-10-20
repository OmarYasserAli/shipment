<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\EmployeeJob as ModelsEmployeejob;
use App\Models\Employees;
use App\Models\Employer;
use App\Models\Employer_employee;
use App\Models\Job;
use App\Models\Report;
use EmployeeJob;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Setting;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	public $settings;
	//protected $loggedInUser;
    public function __construct()
    {

        
       //$this->loggedInUser=auth()->user();
        
    }
    public function init_Settings(){
    	$this->settings= Setting::all()->pluck('val','name')->toArray();
    }
    

    
    // public function test(){
    //     return Employees::with('report')->get();
    // }
}
