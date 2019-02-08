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


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

Auth::routes();

Route::get('/user/registration', 'HomeController@registration');
Route::post('/user/registration/save', 'HomeController@registrationSave');
Route::get('/user/confirm/{id}', 'HomeController@confirmMail');

Route::get('/user/forget-pass', 'HomeController@forgetPass');


Route::get('/', 'HomeController@login');
Route::get('/home', 'HomeController@index');
Route::get('/login', 'HomeController@login');
Route::post('/login-check', 'HomeController@doLogin');
Route::get('/logout', 'HomeController@doLogout');


Route::get('/admin-home', function () {
    if (!Auth::check()) {
        return view('login');
    } else {
        $unseen_notifications = \App\Leave::join('users', 'users.id', '=', 'leaves.user_id')->where('leaves.grant_officers_decision', 0)->get();
        $unseen_replacement_notifications = \App\Leave::join('users', 'users.id', '=', 'leaves.replacement_person_id')->where('leaves.replacement_person_id', Session::get('id'))->where('replacement_person_agreement', 0)->get();

        $user_count = \App\User::count();
        $leave_count = \App\Leave::count();
        $pending = \App\Leave::where('grant_officers_decision', 0)->count();
        $accepted = \App\Leave::where('grant_officers_decision', 1)->count();
        $failed = \App\Leave::where('grant_officers_decision', 2)->count();

        $all_leave_request = \App\Leave::join('users', 'users.id', '=', 'leaves.user_id')->orderBy('leaves.leave_id', 'DESC')->get([
                'leaves.created_at',
                'leaves.applicant_leave_from',
                'leaves.applicant_leave_to',
                'users.name'
            ]

        );
        return view('pages.home.index')
            ->with('unseen_notifications', $unseen_notifications)
            ->with('user_count', $user_count)
            ->with('leave_count', $leave_count)
            ->with('accepted', $accepted)
            ->with('pending', $pending)
            ->with('failed', $failed)
            ->with('all_leave_request', $all_leave_request)
            ->with('unseen_replacement_notifications', $unseen_replacement_notifications);
    }

});


// routes/web.php
Route::group([], function () {
    //Manage Users
    Route::get('/user/create', 'UserController@create');
    Route::post('/user/store', 'UserController@store');
    Route::get('/user/show', 'UserController@show');
    Route::get('/user/edit/{id}', 'UserController@edit');
    Route::post('/user/update', 'UserController@update');
    Route::get('/user/destroy/{id}', 'UserController@destroy');
    Route::get('/user/account-activate', 'UserController@accountActivate');


    Route::get('/user/deactive/{id}', 'UserController@deactivate');
    Route::get('/user/active/{id}', 'UserController@activate');

//Manage Leave Application
    Route::get('/leave/create', 'LeaveController@create');
    Route::post('/leave/store', 'LeaveController@store');
    Route::get('/leave/show', 'LeaveController@show');
    Route::get('/leave/edit/{id}', 'LeaveController@edit');
    Route::post('/leave/update', 'LeaveController@update');
    Route::get('/leave/destroy/{id}', 'LeaveController@destroy');
    Route::get('/leave/all', 'LeaveController@all');
    Route::get('/leave/details/{id}', 'LeaveController@details');
    Route::post('/leave/search', 'LeaveController@search');

//Replacement
    Route::get('/leave/replacement', 'LeaveController@replacement');
    Route::get('/leave/replacement/accept/{id}', 'LeaveController@replacementAccept');
    Route::get('/leave/replacement/cancel/{id}', 'LeaveController@replacementCancel');

//Recommend Officer Approval
    Route::get('/leave/recommend/accept/{id}', 'LeaveController@recommendAccept');
    Route::get('/leave/recommend/cancel/{id}', 'LeaveController@recommendCancel');

//Grant Officer Approval
    Route::post('/leave/grant/accept/done', 'LeaveController@grantAccept');
    Route::post('/leave/grant/cancel/done', 'LeaveController@grantCancel');

    Route::get('/leave/grant/accept/{id}', 'LeaveAcceptTrackController@grantAccept');
    Route::get('/leave/grant/cancel/{id}', 'LeaveAcceptTrackController@grantCancel');

//Profile
    Route::get('/user/profile', 'SettingController@profile');
    Route::get('/user/profile/edit', 'SettingController@editProfile');
    Route::post('/user/profile/update', 'SettingController@updateProfile');

});




