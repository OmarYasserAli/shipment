<?php

namespace App\Http\Controllers\setting;

use App\Http\Controllers\Controller;
use App\User;
use App\Models\Mohfza;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class userdefinationsController extends Controller
{
        public function addClient()
        {
        	return view('users.addClient');
        }
        public function addMandoub()
        {
        	return view('users.addMandoub');
        }
        public function adduser()
        {
        	return view('users.adduser');
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
