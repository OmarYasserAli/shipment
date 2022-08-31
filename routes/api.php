<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Kutia\Larafirebase\Facades\Larafirebase;



Route::get('/clear-cache',function(){
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    // Artisan::call('jwt:secret');
    return "cache clear";
});
Route::post('register', 'Authentication\register@register');
Route::post('login', 'Authentication\authentication@authenticate')->name('all_user');
Route::post('logout', 'Authentication\authentication@logout');
Route::get('getAllbranch','general\BranchController@allbranch');
Route::get('getCommerical','general\BranchController@commerical');
Route::post('delete-user', 'Authentication\authentication@deleteUser')->name('deleteUser');

//client
Route::prefix('client')->group(function () {
    
    Route::get('store_ship','Client\HomeController@Store_shipment');
    Route::get('hasrec','Client\HomeController@Rec_shipment');
    Route::get('hasclient','Client\HomeController@Client_shipment');
    Route::get('hasdelegate','Client\HomeController@Delegate_shipment');
    Route::get('partial_shipment','Client\HomeController@Partial_shipment');
    Route::get('recived','Client\HomeController@Recived');
    Route::get('returnfromclient','Client\HomeController@ReturnClient');
    Route::get('returnfromstore','Client\HomeController@ReturnStore');
    Route::get('later','Client\HomeController@later');
    Route::post('search_ship','Client\HomeController@search_ship');
    Route::post('addreport','Client\ReportController@Addreport');
    Route::get('allreport','Client\ReportController@allreport');
   
});

Route::get('home-page','general\HomeController@HomePage');
Route::get('daily-shipments','general\HomeController@dailyShipments');
Route::get('shipments','general\HomeController@shipments');
Route::post('shipments/update','general\HomeController@updateShipment');
Route::post('shipments/store','general\HomeController@store');
Route::get('accounting','general\HomeController@accounting');
Route::get('accounting-shipments','general\HomeController@accounting_shipments');
Route::post('shipments/edit/uid','general\HomeController@editUid');


Route::get('get-shipment-delevery','general\HomeController@get_shipment_delevery');
Route::get('getShipmentsByRecNum','general\HomeController@getShipmentsByRecNum');


Route::post('estlm-rag3','general\HomeController@estlm_rag3');
Route::post('tanfez-estlm-rag3','general\HomeController@tanfez_estlm_rag3');
Route::post('estlam','general\HomeController@estlam');
Route::post('estlam-check','general\HomeController@estlam_check');
Route::post('taslim','general\HomeController@taslim');
Route::post('taslim-check','general\HomeController@taslim_check');

Route::post('wasel-goz2e-mandob-taslem','general\HomeController@wasel_goz2e_mandob_taslem');
Route::post('taslem-mandob-taslem','general\HomeController@taslem_mandob_taslem');


Route::post('wasel-goz2e-mandob-taslem','general\HomeController@wasel_goz2e_mandob_taslem');
Route::post('taslem-mandob-taslem','general\HomeController@taslem_mandob_taslem');





//estlam
Route::get('estlam-shipments-count','general\HomeController@estlam_shipments_count');
Route::get('estlam-shipments','general\HomeController@estlam_shipments');
Route::get('estlam-commercial-names','general\HomeController@estlam_commercial_names');


Route::post('chatopen','general\HomeController@chat_open');