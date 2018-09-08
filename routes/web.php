<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/***********************Custom Route********************************/
Route::get('/', function () {
    return view('login');
});

Route::GET('logout', function () {
    session_start();
    $_SESSION['user_master'] = null;
    return redirect('/');
});

Route::GET('change_password', function () {
    return view('change_password');
});
Route::POST('reset_password', 'LoginMasterController@reset_password');
Route::GET('user_master/{id}/resetPassword', 'LoginMasterController@reset');

Route::POST('change_password', 'LoginMasterController@change_password');
Route::GET('dashboard', 'LoginMasterController@login_user');

Route::get('vehicle/{id}/booked', 'VehicleMasterController@booked');
Route::get('vehicle/{id}/available', 'VehicleMasterController@available');

Route::get('hotel/{id}/booked', 'HotelMasterController@booked');
Route::get('hotel/{id}/available', 'HotelMasterController@available');

Route::get('hotel_info/{id}/info', 'HotelInfoController@index');
Route::get('hotel_info/{id}/create', 'HotelInfoController@create');

/*********************Tour****************/
Route::get('tour/{id}/create', 'TourMasterController@create');
Route::get('tour/{id}/planning', 'TourMasterController@create_planning');
Route::get('tour/{id}/itinerary', 'TourMasterController@create_itinerary');
Route::get('tour/{id}/itinerary_by_lead', 'TourMasterController@create_itinerary_by_lead');  //15-Nov-2017
Route::get('event/{id}/create', 'TourPlanningController@create');

/*************14_April_2018*************/
Route::get('itinerary_day/{id}', 'TourMasterController@add_days');
Route::get('itinerary_day/{id}/remove', 'TourMasterController@remove_days');
Route::resource('policy', 'PolicyController');
Route::get('policy/{id}/delete', 'PolicyController@delete');
/*************14_April_2018*************/




Route::get('itinerary_event/{id}/delete', 'ItineraryInfoController@remove_event');

/*********Auto Type Search**************/
Route::get('gpdetail', 'ItineraryInfoController@autoComplete');
Route::get('transfersearch', 'ItineraryInfoController@transfer_search');
/*********Auto Type Search**************/

/*****vehicle******/
Route::get('tour/{id}/vehicle', 'TourMasterController@add_vehicle');
Route::post('tour/{id}/add_vehicle', 'TourMasterController@store_vehicle');
Route::get('vehicle/{id}/remove', 'TourMasterController@remove_vehicle');
/*****vehicle******/


Route::get('itinerary/{id}/print', 'ItineraryInfoController@print_itinerary');

/*****After final demo******/
Route::post('_gsentence', 'ItineraryInfoController@getSentenceList');
Route::post('itinerary/{id}/hotel', 'itineraryInfoController@hotel_information');
Route::get('itinerary/{id}/create', 'itineraryInfoController@create');
Route::post('_gvehicle', 'TourMasterController@view_vehicle');
Route::post('_ginclusion', 'TourMasterController@view_inclusion');
Route::get('itinerary/{id}/remove', 'itineraryInfoController@removetourinfo');


Route::get('tour/{id}/inclusion', 'TourMasterController@add_inclusion');
Route::post('tour/{id}/add_inclusion', 'TourMasterController@store_inclusion');
Route::get('inclusion/{id}/remove', 'TourMasterController@removeInclusion');




Route::post('_ievent', 'ItineraryInfoController@view_itinerary');
//Route::post('_groom', 'TourPlanningController@getRoom');
Route::post('_groom', 'TourPlanningController@getRoomList');
Route::post('_gevent', 'TourPlanningController@view_event');
Route::post('_vevent', 'TourPlanningController@view_hotel_info');
//Route::get('tour/{id}/event', 'TourPlanningController@view_event');


/***********************Custom Route********************************/

/****************************Crud Route******************************/
Route::resource('home', 'LoginMasterController');
Route::resource('user_master', 'UserMasterController');
Route::resource('enquiry', 'EnquiryMaster\EnquiryMasterController');
Route::resource('lead', 'LeadMaster\LeadMasterController');
Route::resource('vehicle', 'VehicleMasterController');
Route::resource('hotel', 'HotelMasterController');
Route::resource('place', 'PlaceMasterController');
Route::resource('inclusion', 'InclusionMasterController');
Route::resource('tour', 'TourMasterController');
Route::resource('event', 'TourPlanningController');
Route::resource('itinerary', 'ItineraryInfoController');
Route::resource('hotel_info', 'HotelInfoController');
Route::resource('sentence', 'SentenceMasterController');
Route::resource('category', 'CategoryController');
/****************************Crud Route******************************/

/******Lead******/
ROUTE::POST('lead/{id}/update', 'LeadMaster\LeadMasterController@updateLeadAfterAssign');
Route::POST('_cLeadAssgn', 'LeadMaster\LeadMasterController@assignLeadToCounsellor');
ROUTE::POST('_clsLead', 'LeadMaster\LeadMasterController@closeLeadConfirm');
ROUTE::POST('_clsLeadCfm/{id}/close', 'LeadMaster\LeadMasterController@closeLeadAfterAssign');
Route::GET('_enqToLead/{id}', 'LeadMaster\LeadMasterController@setEnquiryToLead');
Route::GET('lead/{id}/add', 'LeadMaster\LeadMasterController@addComment');
Route::POST('lead/{id}/addComments', 'LeadMaster\LeadMasterController@storeComment');


Route::GET('home_counsellor', 'LeadMaster\LeadMasterController@counsellorHome');
Route::GET('home_marketing', 'LoginMasterController@marketingHome');
Route::POST('_gflwupfrm', 'LeadMaster\LeadMasterController@getFollowUpForm');
Route::POST('_gflwup/{id}', 'LeadMaster\LeadMasterController@getFollowUp');
Route::POST('_gCnvtFrm', 'LeadMaster\LeadMasterController@getLeadConvertForm');
Route::POST('_gldcnvr/{id}', 'LeadMaster\LeadMasterController@getLeadConversion');
Route::POST('_gNRF', 'LeadMaster\LeadMasterController@getLeadNoResponseForm');
Route::POST('_gldNR/{id}', 'LeadMaster\LeadMasterController@getLeadNoResponse');

// Filter Lead Table Data
//ROUTE::POST('_all/{id}', 'LeadMaster\LeadMasterController@getFilteredIndex');
//ROUTE::POST('_assigned/{id}', 'LeadMaster\LeadMasterController@getFilteredIndex');
//ROUTE::POST('_followup/{id}', 'LeadMaster\LeadMasterController@getFilteredIndex');
//ROUTE::POST('_converted/{id}', 'LeadMaster\LeadMasterController@getFilteredIndex');
//ROUTE::POST('_completed/{id}', 'LeadMaster\LeadMasterController@getFilteredIndex');
//ROUTE::POST('_fresh/{id}', 'LeadMaster\LeadMasterController@getFilteredIndex');

//Route::POST('lead/{filter}/filter', 'LeadMaster\LeadMasterController@getFilteredIndex');
Route::GET('lead/{filter}/filter', 'LeadMaster\LeadMasterController@getFilteredIndex');
/*********Teacher*************/
//Route::GET('home_teacher', 'LeadMaster\LeadMasterController@counsellorHome');

/********delete Route***********/
Route::get('enquiry/{id}/delete', 'EnquiryMaster\EnquiryMasterController@destroy');
Route::get('lead/{id}/delete', 'LeadMaster\LeadMasterController@destroy');
Route::get('vehicle/{id}/delete', 'VehicleMasterController@destroy');
Route::get('hotel/{id}/delete', 'HotelMasterController@destroy');
Route::get('place/{id}/delete', 'PlaceMasterController@destroy');
Route::get('inclusion/{id}/delete', 'InclusionMasterController@destroy');
Route::get('tour/{id}/delete', 'TourMasterController@destroy');
Route::get('hotel_info/{id}/delete', 'HotelInfoController@destroy');
Route::get('sentence/{id}/delete', 'SentenceMasterController@destroy');
Route::get('category/{id}/delete', 'CategoryController@destroy');
Route::get('user_master/{id}/delete', 'UserMasterController@destroy');
Route::get('user_master/{id}/activate', 'UserMasterController@activate');
/********delete Route***********/