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

Route::get('/', function () {
	return view('welcome');
})->name('root');

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

//Routes with Role Middleware

Route::middleware(['auth'])->group(function () {

//Roles
	Route::post('roles/store', 'RoleController@store')->name('roles.store')
		->middleware('can:roles.create');

	Route::get('roles', 'RoleController@index')->name('roles.index')
		->middleware('can:roles.index');

	Route::get('roles/create', 'RoleController@create')->name('roles.create')
		->middleware('can:roles.create');

	Route::put('roles/{role}', 'RoleController@update')->name('roles.update')
		->middleware('can:roles.edit');

	Route::get('roles/{role}', 'RoleController@show')->name('roles.show')
		->middleware('can:roles.show');

	Route::delete('roles/{role}', 'RoleController@destroy')->name('roles.destroy')
		->middleware('can:roles.destroy');

	Route::get('roles/{role}/edit', 'RoleController@edit')->name('roles.edit')
		->middleware('can:roles.edit');
//Users
	Route::get('users/export/', 'UserController@exportXlsx');
	Route::get('users/pdf/', 'UserController@exportPDF');

	Route::get('users', 'UserController@index')->name('users.index')
		->middleware('can:users.index');

	Route::post('users/store', 'UserController@store')->name('users.store')
		->middleware('can:users.create');

	Route::get('users/trash', 'UserController@trash')->name('users.trash')
		->middleware('can:users.trash');

	Route::get('users/create', 'UserController@create')->name('users.create')
		->middleware('can:users.create');

	Route::put('users/{user}', 'UserController@update')->name('users.update')
		->middleware('can:users.edit');

	Route::get('users/{user}', 'UserController@show')->name('users.show')
		->middleware('can:users.show');

	Route::get('/users/restore/{id}', 'UserController@restore')->name('users.restore')
		->middleware('can:users.restore');

	Route::delete('users/{user}', 'UserController@destroy')->name('users.destroy')
		->middleware('can:users.destroy');

	Route::get('users/{user}/edit', 'UserController@edit')->name('users.edit')
		->middleware('can:users.edit');

	//Settings

	Route::get('settings', 'SettingController@index')->name('settings.index')
		->middleware('can:settings.index');

	Route::get('settings/create', 'SettingController@create')->name('settings.create')
		->middleware('can:settings.create');

	Route::put('settings/{setting}', 'SettingController@update')->name('settings.update')
		->middleware('can:settings.edit');

	Route::get('settings/{setting}/edit', 'SettingController@edit')->name('settings.edit')
		->middleware('can:settings.edit');

	Route::post('settings/store', 'SettingController@store')->name('settings.store')
		->middleware('can:settings.create');

	Route::delete('settings/{setting}', 'SettingController@destroy')->name('settings.destroy')
		->middleware('can:settings.destroy');

	//Patient
	Route::get('patients/export/', 'PatientController@exportXlsx')->name('export');
	Route::get('patients/pdf/', 'PatientController@exportPDF')->name('pdf');

	Route::get('patients', 'PatientController@index')->name('patients.index')
		->middleware('can:patients.index');


	Route::get('patients/create', 'PatientController@create')->name('patients.create')
		->middleware('can:patients.create');

	Route::get('patients/trash', 'PatientController@trash')->name('patients.trash')
		->middleware('can:patients.trash');

	Route::put('patients/{patient}', 'PatientController@update')->name('patients.update')
		->middleware('can:patients.edit');

	Route::get('patients/{patient}/edit', 'PatientController@edit')->name('patients.edit')
		->middleware('can:patients.edit');

	Route::get('patients/{patient}', 'PatientController@show')->name('patients.show')
		->middleware('can:patients.show');

	Route::post('patients/store', 'PatientController@store')->name('patients.store')
		->middleware('can:patients.create');

	Route::delete('patients/{patient}', 'PatientController@destroy')->name('patients.destroy')
		->middleware('can:patients.destroy');

	Route::get('/patients/restore/{id}', 'PatientController@restore')->name('patients.restore')
		->middleware('can:patients.restore');

	

	// Events
    //fullcalender
	Route::get('/events','EventController@index')->name('events.index');
	Route::post('/events/create','EventController@create');
	Route::post('/events/update','EventController@update');
	Route::post('/events/delete','EventController@destroy');
});
