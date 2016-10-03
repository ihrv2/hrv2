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
	// user tabs
	// ---------
	Route::get('mod/user/view/personal/{id}/{token}', array(
		'as'    => 'mod.user.view.personal',
		'uses'   => 'UserController@showUserViewPersonal',
	));  
	Route::get('mod/user/view/job/{id}/{token}', array(
		'as'    => 'mod.user.view.job',
		'uses'   => 'UserController@showUserViewJob',
	));  
	Route::get('mod/user/view/contract/{id}/{token}', array(
		'as'    => 'mod.user.view.contract',
		'uses'   => 'UserController@showUserViewContract',
	));  
	Route::get('mod/user/view/family/{id}/{token}', array(
		'as'    => 'mod.user.view.family',
		'uses'   => 'UserController@showUserViewFamily',
	));  
	Route::get('mod/user/view/education/{id}/{token}', array(
		'as'    => 'mod.user.view.education',
		'uses'   => 'UserController@showUserViewEducation',
	));  
	Route::get('mod/user/view/language/{id}/{token}', array(
		'as'    => 'mod.user.view.language',
		'uses'   => 'UserController@showUserViewLanguage',
	));  
	Route::get('mod/user/view/skill/{id}/{token}', array(
		'as'    => 'mod.user.view.skill',
		'uses'   => 'UserController@showUserViewSkill',
	));  
	Route::get('mod/user/view/employment/{id}/{token}', array(
		'as'    => 'mod.user.view.employment',
		'uses'   => 'UserController@showUserViewEmployment',
	));  
	Route::get('mod/user/view/reference/{id}/{token}', array(
		'as'    => 'mod.user.view.reference',
		'uses'   => 'UserController@showUserViewReference',
	));  
	Route::get('mod/user/view/emergency/{id}/{token}', array(
		'as'    => 'mod.user.view.emergency',
		'uses'   => 'UserController@showUserViewEmergency',
	));  
	Route::get('mod/user/view/photo/{id}/{token}', array(
		'as'    => 'mod.user.view.photo',
		'uses'   => 'UserController@showUserViewPhoto',
	));  





	// modul user	
	// ----------
	Route::get('mod/user', array(
		'as'    => 'mod.user.index',
		'uses'   => 'UserController@showUserIndex',
	));
	Route::post('mod/user', array(
		'uses'   => 'UserController@postUserIndex',
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

	// user password
	Route::get('mod/user/password/{id}/{token}', array(
		'as'    => 'mod.user.password',
		'uses'   => 'UserController@showUserPassword',
	)); 
	Route::post('mod/user/password/{id}/{token}', array(
		'uses'   => 'UserController@updateUserPassword',
	)); 

	// view user details
	Route::get('mod/user/view/{id}/{token}', array(
		'as'    => 'mod.user.view',
		'uses'   => 'UserController@showUserView',
	)); 	




	// user photo
	// ----------
	Route::post('mod/user/photo/upload', array(
		'uses'   => 'UserController@updateUserPhoto',
	)); 	
	Route::post('mod/user/photo/remove', array(
		'uses'   => 'UserController@destroyUserPhoto',
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
	// -----------
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
	Route::post('mod/user/family/delete', array(
		'as'    => 'mod.user.family.delete',
		'uses'   => 'UserController@destroyUserFamily',
	));  		




	// user education
	// --------------
	Route::get('mod/user/education/create/{uid}/{token}', array(
		'as'    => 'mod.user.education.create',
		'uses'   => 'UserController@createUserEducation',
	));
	Route::post('mod/user/education/create/{uid}/{token}', array(
		'uses'   => 'UserController@storeUserEducation',
	));       
	Route::get('mod/user/education/edit/{id}/{uid}/{token}', array(
		'as'    => 'mod.user.education.edit',
		'uses'   => 'UserController@editUserEducation',
	)); 
	Route::post('mod/user/education/edit/{id}/{uid}/{token}', array(
		'uses'   => 'UserController@updateUserEducation',
	)); 
	Route::post('mod/user/education/delete', array(
		'as'    => 'mod.user.education.delete',
		'uses'   => 'UserController@destroyUserEducation',
	));  		





	// user job
	// --------
	Route::get('mod/user/job/create/{uid}/{token}', array(
		'as'    => 'mod.user.job.create',
		'uses'   => 'UserController@createUserJob',
	)); 
	Route::post('mod/user/job/create/{uid}/{token}', array(
		'uses'   => 'UserController@storeUserJob',
	));       
	Route::get('mod/user/job/edit/{id}/{uid}/{token}', array(
		'as'    => 'mod.user.job.edit',
		'uses'   => 'UserController@editUserJob',
	)); 
	Route::post('mod/user/job/edit/{id}/{uid}/{token}', array(
		'uses'   => 'UserController@updateUserJob',
	)); 
	Route::post('mod/user/job/delete', array(
		'as'    => 'mod.user.job.delete',
		'uses'   => 'UserController@destroyUserJob',
	)); 



 
	// user language
	// -------------
	Route::get('mod/user/language/create/{uid}/{token}', array(
		'as'    => 'mod.user.language.create',
		'uses'   => 'UserController@createUserLanguage',
	)); 
	Route::post('mod/user/language/create/{uid}/{token}', array(
		'uses'   => 'UserController@storeUserLanguage',
	));       
	Route::get('mod/user/language/edit/{id}/{uid}/{token}', array(
		'as'    => 'mod.user.language.edit',
		'uses'   => 'UserController@editUserLanguage',
	)); 
	Route::post('mod/user/language/edit/{id}/{uid}/{token}', array(
		'uses'   => 'UserController@updateUserLanguage',
	)); 
	Route::post('mod/user/language/delete', array(
		'as'    => 'mod.user.language.delete',
		'uses'   => 'UserController@destroyUserLanguage',
	)); 




	// user skill
	// ----------
	Route::get('mod/user/skill/create/{uid}/{token}', array(
		'as'    => 'mod.user.skill.create',
		'uses'   => 'UserController@createUserSkill',
	)); 
	Route::post('mod/user/skill/create/{uid}/{token}', array(
		'uses'   => 'UserController@storeUserSkill',
	));       
	Route::get('mod/user/skill/edit/{id}/{uid}/{token}', array(
		'as'    => 'mod.user.skill.edit',
		'uses'   => 'UserController@editUserSkill',
	)); 
	Route::post('mod/user/skill/edit/{id}/{uid}/{token}', array(
		'uses'   => 'UserController@updateUserSkill',
	)); 
	Route::post('mod/user/skill/delete', array(
		'as'    => 'mod.user.skill.delete',
		'uses'   => 'UserController@destroyUserSkill',
	)); 





	// user employment
	// ---------------
	Route::get('mod/user/employment/create/{uid}/{token}', array(
		'as'    => 'mod.user.employment.create',
		'uses'   => 'UserController@createUserEmployment',
	));
	Route::post('mod/user/employment/create/{uid}/{token}', array(
		'uses'   => 'UserController@storeUserEmployment',
	));       
	Route::get('mod/user/employment/edit/{id}/{uid}/{token}', array(
		'as'    => 'mod.user.employment.edit',
		'uses'   => 'UserController@editUserEmployment',
	)); 
	Route::post('mod/user/employment/edit/{id}/{uid}/{token}', array(
		'uses'   => 'UserController@updateUserEmployment',
	)); 
	Route::post('mod/user/employment/delete', array(
		'as'    => 'mod.user.employment.delete',
		'uses'   => 'UserController@destroyUserEmployment',
	)); 




	// user reference
	// --------------
	Route::get('mod/user/reference/create/{uid}/{token}', array(
		'as'    => 'mod.user.reference.create',
		'uses'   => 'UserController@createUserReference',
	)); 
	Route::post('mod/user/reference/create/{uid}/{token}', array(
		'uses'   => 'UserController@storeUserReference',
	));       
	Route::get('mod/user/reference/edit/{id}/{uid}/{token}', array(
		'as'    => 'mod.user.reference.edit',
		'uses'   => 'UserController@editUserReference',
	)); 
	Route::post('mod/user/reference/edit/{id}/{uid}/{token}', array(
		'uses'   => 'UserController@updateUserReference',
	)); 
	Route::post('mod/user/reference/delete', array(
		'as'    => 'mod.user.reference.delete',
		'uses'   => 'UserController@destroyUserReference',
	)); 





	// user emergency contact
	// ----------------------
	Route::get('mod/user/emergency/create/{uid}/{token}', array(
		'as'    => 'mod.user.emergency.create',
		'uses'   => 'UserController@createUserEmergency',
	)); 
	Route::post('mod/user/emergency/create/{uid}/{token}', array(
		'uses'   => 'UserController@storeUserEmergency',
	));       
	Route::get('mod/user/emergency/edit/{id}/{uid}/{token}', array(
		'as'    => 'mod.user.emergency.edit',
		'uses'   => 'UserController@editUserEmergency',
	)); 
	Route::post('mod/user/emergency/edit/{id}/{uid}/{token}', array(
		'uses'   => 'UserController@updateUserEmergency',
	)); 
	Route::post('mod/user/emergency/delete', array(
		'as'    => 'mod.user.emergency.delete',
		'uses'   => 'UserController@destroyUserEmergency',
	)); 
	




	// modul public holiday
	// --------------------
	Route::get('mod/public-holiday', array(
		'as'    => 'mod.public.holiday',
		'uses'   => 'MaintenanceController@showPublicHoliday',
	)); 	
	Route::post('mod/public-holiday', array(
		'uses'   => 'MaintenanceController@postPublicHoliday',
	)); 	




	// modul region
	// ------------
	Route::get('mod/region', array(
		'as'    => 'mod.region.index',
		'uses'   => 'MaintenanceController@showRegionIndex',
	)); 	
	Route::get('mod/region/edit/{id}', array(
		'as'    => 'mod.region.edit',
		'uses'   => 'MaintenanceController@showRegionEdit',
	)); 
	Route::post('mod/region/edit/{id}', array(
		'uses'   => 'MaintenanceController@updateRegionEdit',
	)); 





	// modul site
	// ----------
	Route::get('mod/site', array(
		'as'    => 'mod.site.index',
		'uses'   => 'MaintenanceController@showSiteIndex',
	));
	Route::post('mod/site', array(
		'as'    => 'mod.site.index',
		'uses'   => 'MaintenanceController@postSiteIndex',
	)); 		
	Route::get('mod/site/edit/{id}', array(
		'as'    => 'mod.site.edit',
		'uses'   => 'MaintenanceController@showSiteEdit',
	)); 
	Route::post('mod/site/edit/{id}', array(
		'uses'   => 'MaintenanceController@updateSiteEdit',
	));
	Route::get('mod/site/create', array(
		'as'    => 'mod.site.create',
		'uses'   => 'MaintenanceController@createSiteAdd',
	)); 
	Route::post('mod/site/create', array(
		'uses'   => 'MaintenanceController@storeSiteAdd',
	));


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



});




// group for site supervisor
// -------------------------
Route::group(['middleware' => ['auth', 'sv']], function()
{	
	// leave
	Route::get('leave', array(
		'as'    => 'sv.leave.index',
		'uses'   => 'LeaveController@showLeaveIndex',
	)); 			
	Route::post('leave', array(
		'uses'   => 'LeaveController@postLeaveIndex',
	));       

	// view leave      
	Route::get('leave/view/{id}/{uid}/{token}', array(
		'as'    => 'sv.leave.view',
		'uses'   => 'LeaveController@showLeaveView',
	));  
	Route::post('leave/view/{id}/{uid}/{token}', array(
		'uses'   => 'LeaveController@postLeaveView',
	)); 

	// edit leave 
	Route::get('leave/edit/{id}', array(
		'as'    => 'sv.leave.edit',
		'uses'   => 'LeaveController@showLeaveEdit',
	));
	Route::post('leave/edit/{id}', array(
		'uses'   => 'LeaveController@postLeaveEdit',
	));

	// leave summary
	Route::get('leave/summary', array(
		'as'    => 'sv.leave.summary',
		'uses'   => 'LeaveController@showLeaveSummary',
	)); 

	// add leave         
	Route::get('leave/select', array(
		'as'    => 'sv.leave.select',
		'uses'   => 'LeaveController@showLeaveSelect',
	));   
	Route::post('leave/select', array(
		'uses'   => 'LeaveController@postLeaveSelect',
	));    
	Route::get('leave/create', array(
		'as'    => 'sv.leave.create',
		'uses'   => 'LeaveController@showLeaveCreate',
	));   
	Route::post('leave/create', array(
		'uses'   => 'LeaveController@storeLeaveCreate',
	));    
	
	// replacement leave          
	Route::get('leave/replacement', array(
		'as'    => 'sv.leave.replacement.index',
		'uses'   => 'LeaveController@showLeaveRepIndex',
	));          
	Route::post('leave/replacement', array(
		'uses'   => 'LeaveController@postLeaveRepIndex',
	));      
	Route::get('leave/replacement/create', array(
		'as'    => 'sv.leave.replacement.create',
		'uses'   => 'LeaveController@showLeaveRepCreate',
	));   
	Route::post('leave/replacement/create', array(
		'uses'   => 'LeaveController@storeLeaveRepCreate',
	));               
	Route::get('leave/replacement/view/{id}', array(
		'as'    => 'sv.leave.replacement.view',
		'uses'   => 'LeaveController@showLeaveRepView',
	));   
	Route::post('leave/replacement/view/{id}', array(
		'uses'   => 'LeaveController@postLeaveRepView',
	));  
	Route::get('leave/replacement/edit/{id}', array(
		'as'    => 'sv.leave.replacement.edit',
		'uses'   => 'LeaveController@showLeaveRepEdit',
	));   
	Route::post('leave/replacement/edit/{id}', array(
		'uses'   => 'LeaveController@postLeaveRepEdit',
	)); 
});
