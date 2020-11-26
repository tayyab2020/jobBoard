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

/*Route::get('/', function () {
    return view('welcome');
});*/


Route::group(['middleware' => 'App\Http\Middleware\UserTypeMiddleware'], function() {
    Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {

        Route::get('/', ['as' => 'login', 'uses' => 'IndexController@index']);
        Route::post('login', 'IndexController@postLogin');
        Route::get('confirmUserType', function () {
            return view('admin.confirmUserType');
        });
        Route::get('logout', 'IndexController@logout');
        Route::get('dashboard', 'DashboardController@index');
        Route::get('profile', 'AdminController@profile');
        Route::get('savedjobs', 'AdminController@getSavedJobs');
        Route::post('savejob', 'AdminController@savejob');
        Route::post('savecandidate', 'AdminController@savecandidate');
        Route::get('savedjobs/delete/{id}/{job_slug}', 'AdminController@deletejob');
        Route::get('candidate/delete/{id}/{candidate_id}', 'AdminController@deletecandidate');

        Route::post('profile', 'AdminController@updateProfile');
        Route::post('profile_pass', 'AdminController@updatePassword');
        Route::get('settings', 'SettingsController@settings');
        Route::post('settings', 'SettingsController@settingsUpdates');
        Route::post('social_links', 'SettingsController@social_links_update');
        Route::post('addthisdisqus', 'SettingsController@addthisdisqus');
        Route::post('about_us', 'SettingsController@about_us_page');
        Route::post('careers_with_us', 'SettingsController@careers_with_us_page');
        Route::post('terms_conditions', 'SettingsController@terms_conditions_page');
        Route::post('privacy_policy', 'SettingsController@privacy_policy_page');
        Route::post('headfootupdate', 'SettingsController@headfootupdate');

        Route::get('slider', 'SliderController@sliderlist');
        Route::get('slider/addslide', 'SliderController@addeditSlide');
        Route::post('slider/addslide', 'SliderController@addnew');
        Route::get('slider/addslide/{id}', 'SliderController@editSlide');
        Route::get('slider/delete/{id}', 'SliderController@delete');


        Route::get('applicationtips', 'applicationtipsController@applicationtipslist');
        Route::get('applicationtips/addapplicationtip', 'applicationtipsController@addeditapplicationtips');
        Route::post('applicationtips/addapplicationtip', 'applicationtipsController@addnew');
        Route::get('applicationtips/addapplicationtip/{id}', 'applicationtipsController@editapplicationtip');
        Route::get('applicationtip/delete/{id}', 'applicationtipsController@delete');


        Route::get('jobs', 'JobsController@jobslist');
        Route::get('savedCandidates', 'JobsController@candidateslist');
        Route::get('jobs/addjob', 'JobsController@addeditjob');
        Route::post('jobs/addjob', 'JobsController@addnew');
        Route::get('jobs/addjob/{id}', 'JobsController@editjob');
        Route::get('jobs/status/{id}', 'JobsController@status');

        Route::get('jobs/urgentjob/{id}', 'JobsController@urgentjob');
        Route::get('jobs/delete/{id}', 'JobsController@delete');
        Route::get('urgentjobs', 'urgentJobsController@jobslist');


        Route::get('users', 'UsersController@userslist');
        Route::get('users/adduser', 'UsersController@addeditUser');
        Route::post('users/adduser', 'UsersController@addnew');
        Route::get('users/adduser/{id}', 'UsersController@editUser');
        Route::get('users/delete/{id}', 'UsersController@delete');


        Route::get('cities', 'CityController@citylist');
        Route::get('cities/addcity', 'CityController@addeditcity');
        Route::post('cities/addcity', 'CityController@addnew');
        Route::get('cities/addcity/{id}', 'CityController@editcity');
        Route::get('cities/delete/{id}', 'CityController@delete');
        Route::get('cities/status/{id}', 'CityController@status');

        Route::get('blogs', 'BlogController@bloglist');
        Route::get('blog/{id}', 'BlogController@blogdetail');
        Route::get('blogs/addblog', 'BlogController@addeditblog');
        Route::post('blogs/saveblog', 'BlogController@addnew');
        Route::get('blogs/updateblog/{id}', 'BlogController@editblog');
        Route::get('blogs/delete/{id}', 'BlogController@delete');
        Route::get('blogs/status/{id}', 'BlogController@status');


        Route::get('subscriber', 'SubscriberController@subscriberlist');
        Route::get('subscriber/delete/{id}', 'SubscriberController@delete');

        Route::get('partners', 'PartnersController@partnerslist');
        Route::get('partners/addpartners', 'PartnersController@addpartners');
        Route::post('partners/addpartners', 'PartnersController@addnew');
        Route::get('partners/addpartners/{id}', 'PartnersController@editpartners');
        Route::get('partners/delete/{id}', 'PartnersController@delete');

        Route::get('inquiries', 'InquiriesController@inquirieslist');
        Route::get('inquiries/delete/{id}', 'InquiriesController@delete');


        Route::get('types', 'TypesController@typeslist');
        Route::get('types/addtypes', 'TypesController@addedittypes');
        Route::post('types/addtypes', 'TypesController@addnew');
        Route::get('types/addtypes/{id}', 'TypesController@edittypes');
        Route::get('types/delete/{id}', 'TypesController@delete');

    });
});
Route::get('/', 'IndexController@index');
Route::post('savejobalert', 'IndexController@savejobalert');
Route::get('about-us', 'IndexController@aboutus_page');
Route::get('cv/create', 'IndexController@CreateCV');
Route::get('cv/view/{fileName}', 'IndexController@ViewCV');
Route::get('careers-with-us', 'IndexController@careers_with_page');

Route::get('terms-conditions', 'IndexController@terms_conditions_page');

Route::get('privacy-policy', 'IndexController@privacy_policy_page');

Route::get('contact-us', 'IndexController@contact_us_page');

Route::post('contact-us', 'IndexController@contact_us_sendemail');


Route::get('/', 'IndexController@index');
Route::get('/dagen_werkgevers', 'IndexController@index');
Route::get('/application_tips', 'IndexController@gettips');
Route::get('/blogs', 'IndexController@blogs');
Route::get('/blog/{id}', 'IndexController@blogdetails');


Route::post('save-cv', 'IndexController@SaveCV');

Route::post('subscribe', 'IndexController@subscribe');

Route::get('employers', 'AgentsController@index');
Route::get('employer/details/{id}', 'AgentsController@employerDetail');
Route::get('employer/{id}/jobs', 'AgentsController@employerjobs');
Route::post('employers/searchbyName', 'AgentsController@searchByName');
Route::post('employers/searchbyCity', 'AgentsController@searchByCity');
Route::get('employers/filter/{alphabet}', 'AgentsController@filter');

Route::get('candidates', 'AgentsController@candidatesindex');
Route::post('candidates/searchbyName', 'AgentsController@candidatessearchByName');
Route::post('candidates/searchbyCity', 'AgentsController@candidatessearchByCity');
Route::get('candidates/filter/{alphabet}', 'AgentsController@candidatesfilter');
Route::post('candidates/search', 'AgentsController@searchcandidate');

Route::get('jobs', 'JobsController@index');

Route::get('urgent', 'JobsController@urgentjobs');

Route::get('coffeedate', 'JobsController@coffeedatejobs');

Route::get('rent', 'JobsController@rentjobs');

Route::get('jobs/{slug}', 'JobsController@jobsingle');
Route::get('jobs/user/{id}/{jobid}', 'JobsController@jobsuser');

Route::get('type/{slug}', 'JobsController@jobsbytype');

Route::post('agentscontact', 'JobsController@agentscontact');
Route::post('agentscontactpersonal', 'JobsController@agentscontactpersonal');

Route::post('searchjobs', 'JobsController@searchjobs');

Route::post('search', 'JobsController@searchjobs');


Route::get('login', 'IndexController@login');
Route::post('login', 'IndexController@postLogin');

Route::get('register', 'IndexController@register');
Route::post('register', 'IndexController@postRegister');
Route::get('register_employer', 'IndexController@register_employer');
Route::post('register_employer', 'IndexController@postRegister_employer');

Route::get('logout', 'IndexController@logout');

// Password reset link request routes...
Route::get('admin/password/email', 'Auth\PasswordController@getEmail');
Route::post('admin/password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('admin/password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('admin/password/reset', 'Auth\PasswordController@postReset');

Route::get('auth/confirm/{code}', 'IndexController@confirm');

Route::get ( '/redirect/{service}', 'IndexController@redirect' );

Route::get ( '/callback/{service}', 'IndexController@callback' );
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::get('saveUserType/{userType}', 'IndexController@saveUserType');
    Route::get('confirmUserType', function () {
        return view('admin.confirmUserType');
    });
});
