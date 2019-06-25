<?php

namespace App\Http\Controllers;

use App\Models\TeacherPayment;
use Illuminate\Http\Request;
use DB;

class TeacherPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $all = DB::select('
            SELECT
                class_log.idclass_log,
                teacher_payment.idteacher_payment,
                teacher_payment.admin_idadmin,
                teacher_payment.issue_date,
                teacher_payment.updated_at,
                teacher_payment.amount,
                teacher_payment.class_log_idclass_log,
                aclass.`name`,
                aclass.hourly_rate,
                aclass.institute_rate,
                teacher.idteacher,
                concat( teacher.fname, " ", teacher.lname ) AS teacher_name
            FROM
                teacher_payment
                LEFT OUTER JOIN class_log ON teacher_payment.class_log_idclass_log = class_log.idclass_log
                LEFT OUTER JOIN aclass ON class_log.class_idclass = aclass.idclass
                LEFT OUTER JOIN teacher ON aclass.teacher_idteacher = teacher.idteacher
         ');
       return response()->json(['all'=>$all], 200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TeacherPayment  $teacherPayment
     * @return \Illuminate\Http\Response
     */
    public function show(TeacherPayment $teacherPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TeacherPayment  $teacherPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(TeacherPayment $teacherPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TeacherPayment  $teacherPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TeacherPayment $teacherPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TeacherPayment  $teacherPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(TeacherPayment $teacherPayment)
    {
        //
    }
}
