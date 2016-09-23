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




// api cronjob
Route::group(['prefix' => 'api', 'namespace' => 'api'], function()
{
	Route::get('/cron/user', [
	    'as' => 'api.cron.user', 
	    'uses' => 'CronController@showCronUser'
	]); 	
});




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




// group for admin/hr/rm
Route::group(['middleware' => ['auth', 'default']], function()
{
	// modul sync
	// ----------
	Route::get('mod/sync/user', array(
		'as'    => 'mod.sync.user',
		'uses'   => 'SyncController@showSyncUser',
	));   
	Route::post('mod/sync/user', array(
		'uses'   => 'SyncController@updateSyncUser',
	)); 	
	Route::get('mod/sync/public-holiday', array(
		'as'    => 'mod.sync.public.holiday',
		'uses'   => 'SyncController@showSyncPublicHoliday',
	));   
	Route::post('mod/sync/public-holiday', array(
		'uses'   => 'SyncController@updateSyncPublicHoliday',
	)); 

	// modul user	
	// ----------
	Route::get('mod/user', array(
		'as'    => 'mod.user',
		'uses'   => 'UserController@showUser',
	));
	Route::post('mod/user', array(
		'uses'   => 'UserController@postUser',
	));    

	// select group
	Route::get('mod/user/group', array(
		'as'    => 'mod.user.group',
		'uses'   => 'UserController@showGroup',
	)); 
	Route::post('mod/user/group', array(
		'uses'   => 'UserController@postGroup',
	));  		

	// add user
	Route::get('mod/user/create', array(
		'as'    => 'mod.user.create',
		'uses'   => 'UserController@createUser',
	)); 
	Route::post('mod/user/create', array(
		'uses'   => 'UserController@storeUser',
	)); 

	// edit user password
	Route::get('mod/user/password/{id}/{token}', array(
		'as'    => 'mod.user.password',
		'uses'   => 'UserController@editUserPassword',
	)); 
	Route::post('mod/user/password/{id}/{token}', array(
		'uses'   => 'UserController@updateUserPassword',
	)); 

	// view user details
	Route::get('mod/user/view/{id}/{token}', array(
		'as'    => 'mod.user.view',
		'uses'   => 'UserController@showUserView',
	)); 	

	// user contract
	// -------------
	Route::get('mod/user/contract/create/{uid}/{token}', array(
		'as'    => 'mod.user.contract.create',
		'uses'   => 'UserController@createUserContract',
	)); 
	Route::post('mod/user/contract/create/{uid}/{token}', array(
		'uses'   => 'UserController@storeUserContract',
	));       
	Route::get('mod/user/contract/edit/{id}/{uid}/{token}', array(
		'as'    => 'mod.user.contract.edit',
		'uses'   => 'UserController@editUserContract',
	)); 
	Route::post('mod/user/contract/edit/{id}/{uid}/{token}', array(
		'uses'   => 'UserController@updateUserContract',
	)); 
	Route::get('mod/user/contract/delete/{id}/{uid}/{token}', array(
		'as'    => 'mod.user.contract.delete',
		'uses'   => 'UserController@destroyUserContract',
	));  

	// user family
	Route::get('mod/user/family/create/{uid}/{token}', array(
		'as'    => 'mod.user.family.create',
		'uses'   => 'UserController@createUserFamily',
	)); 
	Route::post('mod/user/family/create/{uid}/{token}', array(
		'uses'   => 'UserController@storeUserFamily',
	));       
	Route::get('mod/user/family/edit/{id}/{uid}/{token}', array(
		'as'    => 'mod.user.family.edit',
		'uses'   => 'UserController@editUserFamily',
	)); 
	Route::post('mod/user/family/edit/{id}/{uid}/{token}', array(
		'uses'   => 'UserController@updateUserFamily',
	)); 
	Route::get('mod/user/family/delete/{id}/{uid}/{token}', array(
		'as'    => 'mod.user.family.delete',
		'uses'   => 'UserController@destroyUserFamily',
	));  		

	// modul public holiday
	Route::get('mod/public-holiday', array(
		'as'    => 'mod.public.holiday',
		'uses'   => 'MaintenanceController@showPublicHoliday',
	)); 	
	Route::post('mod/public-holiday', array(
		'uses'   => 'MaintenanceController@postPublicHoliday',
	)); 	

	// modul region
	Route::get('mod/region', array(
		'as'    => 'mod.region',
		'uses'   => 'MaintenanceController@showRegion',
	)); 	
	Route::get('mod/region/edit/{id}', array(
		'as'    => 'mod.region.edit',
		'uses'   => 'MaintenanceController@showRegionEdit',
	)); 
	Route::post('mod/region/edit/{id}', array(
		'uses'   => 'MaintenanceController@updateRegionEdit',
	)); 

});


