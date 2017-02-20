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

//Route::get('/', 'WelcomeController@index');
//Route::get('home', 'HomeController@index');

Route::get('checksession','CheckSessionController@index');

Route::get('/','PortalController@index');
Route::post('/','PortalController@store');
Route::get('book/delete/{id}','PortalController@destroy');

Route::post('interest','InterestController@store');

Route::get('evaluation','EvaluationController@search');
Route::post('evaluation','EvaluationController@search');
Route::post('view','EvaluationController@update');
Route::get('view/{id}','EvaluationController@view');
Route::get('notifystudent/{id}','EvaluationController@notifystudent');
Route::post('enrollment','EvaluationController@enrollment');
Route::post('shortcourse','EvaluationController@shortcourse');
Route::get('audit','AuditController@index');
Route::post('audit','AuditController@enrollment');
Route::post('auditshortcourse','AuditController@shortcourse');

Route::get('individual/userid/{id}/requestid/{requestid}', 'AuditController@view');
Route::get('individualshortcourse/userid/{id}/requestid/{requestid}', 'AuditController@shortcourseindividual');
Route::get('roy',function(){
return "Roy";
});

Route::get('changecourse/{id}','EvaluationController@changeCourse');
Route::post('changecourse','EvaluationController@doChange');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

//reports
Route::get('/coenrollment/{id}','ReportsController@assessment');
Route::get('/{course}/students','ReportsController@studentPerCourse');
Route::get('/{course}/shortcourse/students','ReportsController@studentPerShortCourse');
Route::get('/perstudent','ReportsController@perStudent');
Route::get('/subjWGrade/{id}', 'ReportsController@getgrade');
Route::get('/totalcollection', function(){
    return view ('portal.auditcollection');
});
Route::post('/generate/totalcollection', 'ReportsController@totalcollection');
Route::get('/collectionreport', 'ReportsController@collectionreport');

Route::post('/grade/subject','ReportsController@persubjectgrade');

Route::get('/list/subject', function(){
    return view ('forms.perSubj');
});

Route::get('/list/subject/{level}','ReportsController@level');

Route::get('/list/subject/{level}/{term}','ReportsController@persubject');



Route::post('/list/grades','ReportsController@subjectGrades');

Route::get('/list/course', function(){
    return view ('forms.subjGrades');
});
Route::get('/passed/grades/course', function(){
    return view ('forms.PassedsubjGrades');
});
Route::post('/passed/grades','ReportsController@passedGrades');

Route::get('get/list/grades','ReportsController@course');