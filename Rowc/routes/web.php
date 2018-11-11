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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('logview', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@index');
Route::get('/', 'HomeController@index')->name('home');
Route::get('auto-complete-place-data', 'HomeController@getAutoCompleteResult');
Route::get('business', 'UserLoginController@business_index');
Route::get('business/forgot-password', 'UserLoginController@business_forgot_password');
Route::get('business/reset-password/{token}', 'UserLoginController@get_reset_password')->name('business.reset');
//Route::get('login', 'UserLoginController@getUserLogin');
//Route::post('login', ['as'=>'user.auth','uses'=>'UserLoginController@userAuth']);
Route::get('/admin',function(){
    return redirect('admin/login');
});
Route::get('admin/login', 'AdminLoginController@getAdminLogin');
Route::post('admin/login', ['as'=>'admin.auth','uses'=>'AdminLoginController@adminAuth']);
Route::get('admin/password/reset', 'AdminLoginController@reset_password');
Route::post('admin/password/reset', 'AdminLoginController@post_reset_password');
Route::get('admin/password/reset/{token}', 'AdminLoginController@get_reset_password');
Route::post('admin/update-reset-password', 'AdminLoginController@update_reset_password');

Route::get('login','UserLoginController@login');
Route::post('post-login-data','UserLoginController@post_login_data');

Route::get('register','UserLoginController@register');
Route::post('post-parent-data','UserLoginController@post_parent_data');

Route::get('forgot-password','UserLoginController@forgot_password');
Route::post('post-forgot-password','UserLoginController@post_forgot_password');


//filter event data



Route::group(['middleware' => ['web']], function () {

});
Route::group(array('prefix' => 'coach', 'middleware' => 'customer'), function () {


});
Route::group(array('prefix' => 'parent', 'middleware' => 'business'), function () {
    Route::get('dashboard','UserLoginController@dashboard');
    Route::get('parent_logout', 'UserLoginController@parent_logout');
    Route::get('get-profile', 'UserLoginController@get_profile');
    Route::post('update-parent-data', 'UserLoginController@update_parent_data');
    Route::get('upload-document', 'UserLoginController@document_file');
    Route::post('post-upload-document', 'UserLoginController@post_upload_document');
    Route::get('document-list', 'UserLoginController@document_list');
    Route::get('administrator-list', 'UserLoginController@administrator_list');
});
Route::group(array('prefix' => 'admin', 'middleware' => 'admin'), function () {

    Route::get('access-denied', 'AdminLoginController@access_denide');
    Route::get('/dashboard', ['as'=>'admin.dashboard','uses'=>'AdminLoginController@dashboard']);
    Route::post('/get-section-data','AdminLoginController@get_section_data');
    Route::get('/get-track-student/{id}','AdminLoginController@get_track_student');

    Route::post('logout', ['as'=>'admin.logout','uses'=>'AdminLoginController@logout']);
    Route::resource('emailTemplates', 'EmailTemplateController');
    Route::resource('generalSettings', 'GeneralSettingController');

    Route::get('profile', 'AdminLoginController@get_profile');
    Route::post('update-profile', 'AdminLoginController@update_profile');
    Route::get('change-password', 'AdminLoginController@change_password');
    Route::post('update-password', 'AdminLoginController@update_password');


    Route::resource('sections', 'SectionController');

    Route::resource('tracks', 'TrackController');

    Route::resource('coaches', 'CoachController');

    Route::resource('students', 'StudentController');

    Route::resource('subAdmins', 'SubAdminController');
    Route::post('destroy-sub-admin', 'SubAdminController@destroy_sub_admin');
    Route::post('active-sub-admin', 'SubAdminController@active_sub_admin');
    Route::resource('parentDetails', 'ParentDetailController');

    Route::get('pool-shuffle', 'AdminLoginController@pool_shuffle');
    Route::post('add-track-student', 'AdminLoginController@add_track_student');
    Route::get('track-students-list/{track_id}','AdminLoginController@track_students_list');
    Route::post('delete-track-student','AdminLoginController@delete_track_student');
    Route::post('add-student-attendance','AdminLoginController@add_student_attendance');
    Route::get('get-student-history/{id}','AdminLoginController@get_student_history');

    Route::resource('commonDocuments', 'CommonDocumentController');

    Route::resource('coachDocuments', 'CoachDocumentController');


});









