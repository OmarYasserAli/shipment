<?php

use App\Http\Controllers\Dashboard\CategoryController;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard\cityController;
use App\Http\Controllers\Dashboard\ProfileController;
use Illuminate\Support\Facades\Artisan;

Auth::routes();



Route::get('/', 'HomeController@index')->name('home');
Route::get('/definations/company', 'setting\definationsController@company')->name('company');
Route::get('/definations/city', 'setting\definationsController@addCity')->name('addCity');
Route::get('/definations/branch', 'setting\definationsController@addBranch')->name('addBranch');
Route::get('/getManateqByMa7afza', 'generalController@getManateqByMa7afza')
    ->name('getManateqByMa7afza');


    Route::get('/tas3ir/3amil-5as', 'tas3irController@tas3ir_3amil_5as')->name('tas3ir.3amil_5as');
Route::post('/tas3ir/save-3amel', 'tas3irController@save_3amel')->name('save_tas3ir_3amel');
Route::post('/tas3ir/save-ta7wel', 'tas3irController@save_ta7wel')->name('save_tas3ir_ta7wel');
Route::post('/tas3ir/save-3amel-5as', 'tas3irController@save_3amel_5as')->name('save_3amel_5as');
    
Route::get('/getManateqAndTas3ir5asByMa7afza', 'tas3irController@getManateqAndTas3ir5asByMa7afza')->name('getManateqAndTas3ir5asByMa7afza');

//shipments

Route::get('shiments', 'shipmentsController@HomePage')->name('home-page');
Route::get('shiments/{type}', 'shipmentsController@shipments')->name('shiments');
Route::get('shiment/create', 'shipmentsController@create')->name('shiments.create');
Route::get('shiment/edit', 'shipmentsController@edit')->name('shiments.edit');
Route::get('shiment/status', 'shipmentsController@status')->name('shiments.status');
Route::get('shiment/print', 'shipmentsController@print')->name('shiments.print');
Route::get('shiment/estlamGet', 'shipmentsController@estlamGet')->name('shiments.estlamGet');
Route::get('shiment/changeToArchive', 'shipmentsController@changeToArchive')->name('shiments.changeToArchive');


Route::get('getShipmentsByCode', 'shipmentsController@getShipmentsByCode')->name('getShipmentsByCode');
Route::get('shipment/t7wel_qr', 'shipmentsController@t7wel_qr')->name('shipment.t7wel_qr');
Route::post('shipment/t7wel_qr', 'shipmentsController@t7wel_qr_save')->name('shipment.t7wel_qr_save');
Route::get('shipment/taslim_qr', 'shipmentsController@taslim_qr')->name('shipment.taslim_qr');
Route::post('shipment/taslim_qr', 'shipmentsController@taslim_qr_save')->name('shipment.taslim_qr_save');


//end shipments

//frou3
Route::get('/frou3/export', 'frou3Controller@export')->name('frou3.export');
Route::get('/frou3/import', 'frou3Controller@import')->name('frou3.import');

 //t7wel sho7nat
Route::get('/frou3_t7wel_sho7nat_qr', 'frou3Controller@frou3_t7wel_sho7nat_qr')->name('frou3_t7wel_sho7nat_qr');
Route::get('/frou3_t7wel_sho7nat_qr', 'frou3Controller@frou3_t7wel_sho7nat_qr')->name('frou3_t7wel_sho7nat_qr');
Route::post('/frou3_t7wel_sho7nat_qr', 'frou3Controller@frou3_t7wel_sho7nat_qr_save')->name('frou3_t7wel_sho7nat_qr_save');
Route::get('/accept_frou3_t7wel', 'frou3Controller@accept_frou3_t7wel')->name('accept_frou3_t7wel');
Route::post('/accept_frou3_t7wel', 'frou3Controller@accept_frou3_t7wel_save')->name('accept_frou3_t7wel_save');
Route::get('/accept_t7wel_get', 'frou3Controller@accept_t7wel_get')->name('accept_t7wel_get');
Route::post('/accept_frou3_t7wel_qr_save', 'frou3Controller@accept_frou3_t7wel_save')->name('accept_frou3_t7wel_qr_save');


 //end t7wel sho7nat
 

//t7wel rag3
Route::get('/frou3_t7wel_rag3_qr', 'frou3Controller@frou3_t7wel_rag3_qr')->name('frou3_t7wel_rag3_qr');
Route::post('/frou3_t7wel_rag3_qr_save', 'frou3Controller@frou3_t7wel_rag3_qr_save')->name('frou3_t7wel_rag3_qr_save');

//endt7wel rag3
Route::get('/accept_frou3_rag3', 'frou3Controller@accept_frou3_rag3')->name('accept_frou3_rag3');
Route::post('/accept_frou3_rag3', 'frou3Controller@accept_frou3_rag3_save')->name('accept_frou3_rag3_save');
Route::get('/accept_rag3_get', 'frou3Controller@accept_rag3_get')->name('accept_rag3_get');
Route::post('/accept_frou3_rag3_qr_save', 'frou3Controller@accept_frou3_rag3_save')->name('accept_frou3_rag3_qr_save');





//accounting

Route::get('/frou3/accounting/mosadad', 'frou3Controller@AccountingMosadad')->name('accounting.mosadad');



Route::get('/frou3/accounting/notmosadad', 'frou3Controller@AccountingNotMosadad')->name('accounting.notmosadad');
//end frou3



//users Definations
Route::get('/users/add-client', 'setting\userdefinationsController@addClient')->name('addClient');
Route::get('/users/add-mandoub', 'setting\userdefinationsController@addMandoub')->name('addMandoub');
Route::get('/users/add-user', 'setting\userdefinationsController@adduser')->name('adduser');
Route::get('/users/registrationRequest', 'setting\userdefinationsController@registrationRequest')->name('registrationRequest');
Route::get('/users/commercialNames', 'setting\userdefinationsController@commercialNames')->name('commercialNames');



//end Definations
Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => ['guest']], function () {
    Route::get('/main', function () {
        return view('auth.login');
    });


});

Route::get('/clear', function () {
    Artisan ::call('cache:clear');
    Artisan::call('config:cache');
});
Route::group(
    [
        'prefix'     => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ],
    function () {


        Route::get('/dashboard/home','HomeController@index')->name('dashboard.home');
        Route::prefix('dashboard')->namespace('Dashboard')->middleware(['auth'])->name('dashboard.')->group(function () {
            Route::resource('roles', 'RoleController');
            Route::resource('users', 'UserController');
            //doctors
            Route::delete('/doctors/bulk_delete', 'DoctorController@bulkDelete')->name('doctors.bulk_delete');
            Route::resource('doctors', 'DoctorController')->except('show');
            Route::get('/doctors/data','DoctorController@data')->name('doctors.data');
            Route::get('/doctors/forclogout/{id}','DoctorController@forcLogout')->middleware('permission:update-logoutdoctors')->name('doctors.forclogout');
            //patients
            Route::delete('/patients/bulk_delete', 'PatientController@bulkDelete')->name('patients.bulk_delete');
            Route::resource('patients', 'PatientController')->except('show');
            Route::get('/patients/data','PatientController@data')->name('patients.data');
            Route::get('/patients/forclogout/{id}','PatientController@forcLogout')->middleware('permission:update-logoutpatients')->name('patients.forclogout');

            //first aids
            Route::delete('/firstaids/bulk_delete', 'FirstAidController@bulkDelete')->name('firstaids.bulk_delete');
            Route::resource('firstaids', 'FirstAidController')->except('show');;
            Route::get('/firstaids/data','FirstAidController@data')->name('firstaids.data');
            //first aids children
            Route::delete('/firstaidchildren/bulk_delete', 'FirstAidChildController@bulkDelete')->name('firstaidchildren.bulk_delete');
            Route::resource('firstaidchildren', 'FirstAidChildController')->except('show');;
            Route::get('/firstaidchildren/data','FirstAidChildController@data')->name('firstaidchildren.data');
            //emergenc
            Route::delete('/emergencs/bulk_delete', 'EmergencController@bulkDelete')->name('emergencs.bulk_delete');
            Route::resource('emergencs', 'EmergencController')->except('show');;
            Route::get('/emergencs/data','EmergencController@data')->name('emergencs.data');
            //emergenc
            Route::delete('/emergencchildren/bulk_delete', 'EmergencChildController@bulkDelete')->name('emergencchildren.bulk_delete');
            Route::resource('emergencchildren', 'EmergencChildController')->except('show');
            Route::get('/emergencchildren/data','EmergencChildController@data')->name('emergencchildren.data');
            //profile 
            Route::resource('profiles','ProfileController');

           
        });

    });

Route::get('/home', 'HomeController@index')->name('home');
