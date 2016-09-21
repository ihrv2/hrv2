<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/




// initial page
Route::get('/', 'Auth\AuthController@showLoginForm');




// authentication page
Route::auth();





// home controller (already have auth)
Route::get('/home', [
    'as' => 'home', 
    'uses' => 'HomeController@showHome'
]); 		
Route::get('/auth/profile', [
    'as' => 'auth.profile', 
    'uses' => 'HomeController@showProfile'
]); 
Route::get('/auth/password', [
    'as' => 'auth.password', 
    'uses' => 'HomeController@editPassword'
]); 	
Route::post('auth/password', [
    'uses' => 'HomeController@updatePassword'
]);	





// modul of human resource (group_id = 2)
Route::group(['prefix' => 'hr', 'namespace' => 'hr', 'middleware' => ['auth', 'hr']], function()
{



	// modul sync
	Route::get('mod/sync/user', array(
		'as'    => 'hr.mod.sync.user',
		'uses'   => '\App\Http\Controllers\SyncController@showSyncUser',
	));   
	Route::post('mod/sync/user', array(
		'as'    => 'hr.mod.sync.user',		
		'uses'   => '\App\Http\Controllers\SyncController@updateSyncUser',
	)); 	
	Route::get('mod/sync/public-holiday', array(
		'as'    => 'hr.mod.sync.public.holiday',
		'uses'   => '\App\Http\Controllers\SyncController@showSyncPublicHoliday',
	));   
	Route::post('mod/sync/public-holiday', array(
		'uses'   => '\App\Http\Controllers\SyncController@updateSyncPublicHoliday',
	)); 	



	// modul user
	Route::get('mod/user', array(
		'as'    => 'hr.mod.user.index',
		'uses'   => '\App\Http\Controllers\UserController@showUserIndex',
	)); 
	Route::post('mod/user', array(
		'uses'   => '\App\Http\Controllers\UserController@showUserIndex',
	));    
	Route::get('mod/user/select-group', array(
		'as'    => 'hr.mod.user.select.group',
		'uses'   => '\App\Http\Controllers\UserController@showSelectGroup',
	)); 
	Route::post('mod/user/select-group', array(
		'uses'   => '\App\Http\Controllers\UserController@postSelectGroup',
	));  		
	Route::get('mod/user/create', array(
		'as'    => 'hr.mod.user.create',
		'uses'   => '\App\Http\Controllers\UserController@showUserCreate',
	)); 
	Route::post('mod/user/create', array(
		'uses'   => '\App\Http\Controllers\UserController@storeUserCreate',
	)); 

	Route::get('mod/user/password/{id}', array(
		'as'    => 'hr.mod.user.password',
		'uses'   => '\App\Http\Controllers\UserController@showUserPassword',
	)); 
	Route::post('mod/user/password/{id}', array(
		'uses'   => '\App\Http\Controllers\UserController@updateUserPassword',
	)); 
	Route::get('mod/user/view/{id}', array(
		'as'    => 'hr.mod.user.view',
		'uses'   => '\App\Http\Controllers\UserController@showUserView',
	)); 



	// modul public holiday
	Route::get('mod/public-holiday', array(
		'as'    => 'hr.mod.public.holiday',
		'uses'   => '\App\Http\Controllers\MaintenanceController@showPublicHoliday',
	)); 	
	Route::post('mod/public-holiday', array(
		'uses'   => '\App\Http\Controllers\MaintenanceController@postPublicHoliday',
	)); 	



	// modul region
	Route::get('mod/region', array(
		'as'    => 'hr.mod.region',
		'uses'   => '\App\Http\Controllers\MaintenanceController@showRegion',
	)); 	
	Route::get('mod/region/edit/{id}', array(
		'as'    => 'hr.mod.region.edit',
		'uses'   => '\App\Http\Controllers\MaintenanceController@showRegionEdit',
	)); 
	Route::post('mod/region/edit/{id}', array(
		'uses'   => '\App\Http\Controllers\MaintenanceController@updateRegionEdit',
	)); 	



});







// modul for site supervisor (group_id = 3)
Route::group(['namespace' => 'sv', 'middleware' => ['auth', 'sv']], function()
{	
	// leave
	Route::get('mod/leave', array(
		'as'    => 'sv.mod.leave.index',
		'uses'   => '\App\Http\Controllers\LeaveController@showLeaveIndex',
	)); 			
	Route::post('mod/leave', array(
		'uses'   => '\App\Http\Controllers\LeaveController@postLeaveIndex',
	));             
	Route::get('mod/leave/view/{id}', array(
		'as'    => 'sv.mod.leave.view',
		'uses'   => '\App\Http\Controllers\LeaveController@showLeaveView',
	));  
	Route::post('mod/leave/view/{id}', array(
		'uses'   => '\App\Http\Controllers\LeaveController@postLeaveView',
	));  
	Route::get('mod/leave/edit/{id}', array(
		'as'    => 'sv.mod.leave.edit',
		'uses'   => '\App\Http\Controllers\LeaveController@showLeaveEdit',
	));
	Route::post('mod/leave/edit/{id}', array(
		'uses'   => '\App\Http\Controllers\LeaveController@postLeaveEdit',
	));
	Route::get('mod/leave/summary', array(
		'as'    => 'sv.mod.leave.summary',
		'uses'   => '\App\Http\Controllers\LeaveController@showLeaveSummary',
	)); 

	// add leave         
	Route::get('mod/leave/select', array(
		'as'    => 'sv.mod.leave.select',
		'uses'   => '\App\Http\Controllers\LeaveController@showLeaveSelect',
	));   
	Route::post('mod/leave/select', array(
		'uses'   => '\App\Http\Controllers\LeaveController@postLeaveSelect',
	));    
	Route::get('mod/leave/create', array(
		'as'    => 'sv.mod.leave.create',
		'uses'   => '\App\Http\Controllers\LeaveController@showLeaveCreate',
	));   
	Route::post('mod/leave/create', array(
		'uses'   => '\App\Http\Controllers\LeaveController@storeLeaveCreate',
	));    

	// replacement leave          
	Route::get('mod/leave/replacement', array(
		'as'    => 'sv.mod.leave.replacement.index',
		'uses'   => '\App\Http\Controllers\LeaveController@showLeaveRepIndex',
	));          
	Route::post('mod/leave/replacement', array(
		'uses'   => '\App\Http\Controllers\LeaveController@postLeaveRepIndex',
	));      
	Route::get('mod/leave/replacement/create', array(
		'as'    => 'sv.mod.leave.replacement.create',
		'uses'   => '\App\Http\Controllers\LeaveController@showLeaveRepCreate',
	));   
	Route::post('mod/leave/replacement/create', array(
		'uses'   => '\App\Http\Controllers\LeaveController@storeLeaveRepCreate',
	));               
	Route::get('mod/leave/replacement/view/{id}', array(
		'as'    => 'sv.mod.leave.replacement.view',
		'uses'   => '\App\Http\Controllers\LeaveController@showLeaveRepView',
	));   
	Route::post('mod/leave/replacement/view/{id}', array(
		'uses'   => '\App\Http\Controllers\LeaveController@postLeaveRepView',
	));  
	Route::get('mod/leave/replacement/edit/{id}', array(
		'as'    => 'sv.mod.leave.replacement.edit',
		'uses'   => '\App\Http\Controllers\LeaveController@showLeaveRepEdit',
	));   
	Route::post('mod/leave/replacement/edit/{id}', array(
		'uses'   => '\App\Http\Controllers\LeaveController@postLeaveRepEdit',
	)); 
});






// after login except home controller
Route::group(['middleware' => ['auth']], function() 
{		
	// Route::resource('/sync', 'SyncController');
});






// modul for administrator (is_admin is true)
Route::group(['prefix' => 'admin', 'namespace' => 'admin', 'middleware' => ['auth', 'admin']], function()
{
	Route::get('user', [
	    'as' => 'admin.mod.user', 
	    'uses' => '\App\Http\Controllers\UserController@indexListUser'
	]);    	
	Route::get('user/password', [
	    'as' => 'admin.mod.user.password', 
	    'uses' => '\App\Http\Controllers\UserController@showChangePassword'
	]);
});




