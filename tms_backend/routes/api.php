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
Route::get('/all_student_payment',[
    'uses' => 'StudentPaymentController@index'
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




Route::post('/class',[
    'uses' => 'AclassController@store'
]);
Route::post('/admin',[
    'uses' => 'AdminController@store'
]);
Route::post('/attendance',[
    'uses' => 'AttendanceController@store'
]);
Route::post('/class_log',[
    'uses' => 'ClassLogController@store'
]);
Route::post('/enrolment',[
    'uses' => 'EnrolmentController@store'
]);
Route::post('/exam',[
    'uses' => 'ExamController@store'
]);
Route::post('/hall',[
    'uses' => 'HallController@store'
]);
Route::post('/student',[
    'uses' => 'StudentController@store'
]);
Route::post('/student_payment',[
    'uses' => 'StudentPaymentController@store'
]);
Route::post('/student_has_exam',[
    'uses' => 'StudentHasExamController@store'
]);
Route::post('/subject',[
    'uses' => 'SubjectController@store'
]);
Route::post('/teacher',[
    'uses' => 'TeacherController@store'
]);
Route::post('/teacher_payment',[
    'uses' => 'TeacherPaymentController@store'
]);
Route::post('/timeslot',[
    'uses' => 'TimeslotController@store'
]);
Route::post('/user',[
    'uses' => 'UserController@store'
]);



Route::put('/class',[
    'uses' => 'AclassController@update'
]);
Route::put('/admin',[
    'uses' => 'AdminController@update'
]);
Route::put('/attendance',[
    'uses' => 'AttendanceController@update'
]);
Route::put('/class_log',[
    'uses' => 'ClassLogController@update'
]);
Route::put('/enrolment',[
    'uses' => 'EnrolmentController@update'
]);
Route::put('/exam',[
    'uses' => 'ExamController@update'
]);
Route::put('/hall',[
    'uses' => 'HallController@update'
]);
Route::put('/student',[
    'uses' => 'StudentController@update'
]);
Route::put('/student_payment',[
    'uses' => 'StudentPaymentController@update'
]);
Route::put('/student_has_exam',[
    'uses' => 'StudentHasExamController@update'
]);
Route::put('/subject',[
    'uses' => 'SubjectController@update'
]);
Route::put('/teacher',[
    'uses' => 'TeacherController@update'
]);
Route::put('/teacher_payment',[
    'uses' => 'TeacherPaymentController@update'
]);
Route::put('/timeslot',[
    'uses' => 'TimeslotController@update'
]);
Route::put('/user',[
    'uses' => 'UserController@update'
]);


Route::delete('/class',[
    'uses' => 'AclassController@delete'
]);
Route::delete('/admin',[
    'uses' => 'AdminController@delete'
]);
Route::delete('/attendance',[
    'uses' => 'AttendanceController@delete'
]);
Route::delete('/class_log',[
    'uses' => 'ClassLogController@delete'
]);
Route::delete('/enrolment',[
    'uses' => 'EnrolmentController@delete'
]);
Route::delete('/exam',[
    'uses' => 'ExamController@delete'
]);
Route::delete('/hall',[
    'uses' => 'HallController@delete'
]);
Route::delete('/student',[
    'uses' => 'StudentController@delete'
]);
Route::delete('/student_payment',[
    'uses' => 'StudentPaymentController@delete'
]);
Route::delete('/student_has_exam',[
    'uses' => 'StudentHasExamController@delete'
]);
Route::delete('/subject',[
    'uses' => 'SubjectController@delete'
]);
Route::delete('/teacher',[
    'uses' => 'TeacherController@delete'
]);
Route::delete('/teacher_payment',[
    'uses' => 'TeacherPaymentController@delete'
]);
Route::delete('/timeslot',[
    'uses' => 'TimeslotController@delete'
]);
Route::delete('/user',[
    'uses' => 'UserController@delete'
]);