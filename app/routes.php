<?php

//Route::get('/', array('as' => 'home', function () { }));
Route::get('/', array('uses' => 'HomeController@showWelcome'))->before('auth');
Route::get('login', array('uses' => 'HomeController@showLogin'));
Route::post('login', array('uses' => 'HomeController@doLogin'));
Route::get('logout', function()
{
    Auth::logout();
    return Redirect::to('login');
});
Route::get('dbmigrate', 'DbmigrateController@index');
Route::get('deals/gridajax', array('as' => 'gridajax', 'uses' => 'DealsController@gridajax')); 
Route::group([ 'before' => 'auth' ], function() { 

Route::get('directions', 'DirectionsController@index'); 
Route::post('directions/dealers', 'DirectionsController@dealers'); 
//users
Route::post('users/addrole', 'UserController@addrole'); 
//Route::delete('users/{dealer_id)/deleterole/{assigned_role_id}', 'UserController@deleterole'); 
Route::delete('users/deleterole/{assigned_role_id}', 'UserController@deleterole'); 
Route::resource('users', 'UserController');

Route::post('roles/addpermission', 'RolesController@addpermission'); 
Route::delete('roles/deletepermission/{permission_role_id}', 'RolesController@deletepermission'); 
Route::resource('roles', 'RolesController');

Route::get('reports/agents/{id}', 'ReportsController@agents');
Route::resource('reports', 'ReportsController');

Route::resource('manufactures', 'ManufacturesController');

Route::resource('dealergroups', 'DealerGroupController');

Route::post('dealers/disposition', 'DealerController@disposition'); 
Route::get('dealers/{id}/delete', 'DealerController@destroy'); 
Route::resource('dealers', 'DealerController');

Route::resource('dispositions', 'DispositionsController');
Route::resource('settings', 'SettingsController');

Route::get('agents/{id}/dealer/{dealer}/deal/{deal}','AgentsController@deal');
Route::post('agents/{id}/lead/search', 'AgentsController@lead_search');
Route::get('agents/{id}/dealer/{dealer_id}', 'AgentsController@dealer');
Route::get('agents/{id}/profile', 'AgentsController@profile');
Route::resource('agents', 'AgentsController');

Route::get('agents/{id}/leads', 'AgentsController@leads');

Route::resource('permissions', 'PermissionsController');

});
