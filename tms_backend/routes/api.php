<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//----all-----
Route::get('/all_class',[
    'uses' => 'AclassController@index'
]);
Route::get('/all_admin',[
    'uses' => 'AdminController@index'
]);
Route::get('/all_attendance',[
    'uses' => 'AttendanceController@index'
]);
Route::get('/all_class_log',[
    'uses' => 'ClassLogController@index'
]);
Route::get('/all_enrolment',[
    'uses' => 'EnrolmentController@index'
]);
Route::get('/all_exam',[
    'uses' => 'ExamController@index'
]);
Route::get('/all_hall',[
    'uses' => 'HallController@index'
]);
Route::get('/all_student',[
    'uses' => 'StudentController@index'
]);
Route::get('/all_student_has_exam',[
    'uses' => 'StudentHasExamController@index'
]);
Route::get('/all_subject',[
    'uses' => 'SubjectController@index'
]);
Route::get('/all_teacher',[
    'uses' => 'TeacherController@index'
]);
Route::get('/all_teacher_payment',[
    'uses' => 'TeacherPaymentController@index'
]);
Route::get('/all_timeslot',[
    'uses' => 'TimeslotController@index'
]);
Route::get('/all_user',[    
    'uses' => 'UserController@index'
]);