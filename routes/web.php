<?php
Route::redirect('/', 'admin/home');

Auth::routes(['register' => false]);

// Change Password Routes...
Route::get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
Route::patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Employee Information
Route::get('employees', 'EmployeeInformationController@index')->name('employee.index');
Route::get('employee/add', 'EmployeeInformationController@create')->name('employee.create');
Route::post('employee/save', 'EmployeeInformationController@store')->name('employee.store');
Route::get('employee/{id}', 'EmployeeInformationController@show')->name('employee.show');
Route::get('employee/edit/{id}', 'EmployeeInformationController@edit')->name('employee.edit');
Route::post('employee/update', 'EmployeeInformationController@update')->name('employee.update');
Route::delete('employee/destroy/{id}', 'EmployeeInformationController@destroy')->name('employee.destroy');
Route::post('employee_mass_destroy', 'EmployeeInformationController@massDestroy')->name('employee.mass_destroy');
Route::get('import/employee', 'EmployeeInformationController@importView')->name('employee.import');
Route::post('import/to/db/employee', 'EmployeeInformationController@importAction')->name('employee.importtodb');

// Visitor Entry
Route::group(['middleware' => ['auth'], 'prefix' => 'visitor', 'as' => 'visitor.'], function () {
	Route::get('list', 'VisitorInformationController@index')->name('list');
	Route::get('new', 'VisitorInformationController@create')->name('create');
	Route::post('save', 'VisitorInformationController@store')->name('store');
	Route::get('edit/{id}', 'VisitorInformationController@edit')->name('edit');
	Route::post('update', 'VisitorInformationController@update')->name('update');
	Route::delete('destroy/{id}', 'VisitorInformationController@destroy')->name('destroy');
	Route::post('visitor-out', 'HomeController@visitorOut')->name('visitorOut');
});

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::delete('permissions_mass_destroy', 'Admin\PermissionsController@massDestroy')->name('permissions.mass_destroy');
    Route::resource('roles', 'Admin\RolesController');
    Route::delete('roles_mass_destroy', 'Admin\RolesController@massDestroy')->name('roles.mass_destroy');
    Route::resource('users', 'Admin\UsersController');
    Route::delete('users_mass_destroy', 'Admin\UsersController@massDestroy')->name('users.mass_destroy');
});

Route::group(['middleware' => ['auth'], 'prefix' => 'trash', 'as' => 'trash.'], function () {
	Route::get('employee', 'TrashedDataController@employee')->name('employee');
	Route::post('employee/restore/{id}', 'TrashedDataController@employeeRestore')->name('employeeRestore');

	Route::get('visits', 'TrashedDataController@visits')->name('visits');
	Route::post('visits/restore/{id}', 'TrashedDataController@visitsRestore')->name('visitsRestore');

	Route::get('users', 'TrashedDataController@users')->name('users');
	Route::post('users/restore/{id}', 'TrashedDataController@usersRestore')->name('usersRestore');
});

Route::group(['middleware' => ['auth'], 'prefix' => 'report', 'as' => 'report.'], function () {
	Route::get('search', 'ReportController@report')->name('search');
	Route::post('view', 'ReportController@reportView')->name('reportView');
});