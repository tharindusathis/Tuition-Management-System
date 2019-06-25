<?php

namespace App\Http\Controllers;

use App\Models\StudentPayment;
use Illuminate\Http\Request;
use DB;

class StudentPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $all = DB::select('
            SELECT
                concat( admin.fname, " ", admin.lname ) AS admin_name,
                concat( student.fname, " ", student.lname ) AS student_name,
                student_payment.idstudent_payment,
                student_payment.updated_at,
                student_payment.issue_date,
                student_payment.amount,
                admin.idadmin,
                Count( attendance.student_payment_idstudent_payment ) AS attendance_count,
                student.idstudent,
                aclass.`name` AS class_name,
                aclass.idclass
            FROM
                student_payment
                LEFT OUTER JOIN admin ON student_payment.admin_idadmin = admin.idadmin
                LEFT OUTER JOIN attendance ON attendance.student_payment_idstudent_payment = student_payment.idstudent_payment
                LEFT OUTER JOIN student ON attendance.student_idstudent = student.idstudent
                LEFT OUTER JOIN class_log ON attendance.class_log_idclass_log = class_log.idclass_log
                LEFT OUTER JOIN aclass ON class_log.class_idclass = aclass.idclass
            GROUP BY
                student_payment.idstudent_payment,
                student_payment.updated_at,
                student_payment.issue_date,
                student_payment.amount,
                admin.idadmin
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
     * @param  \App\Models\StudentPayment  $studentPayment
     * @return \Illuminate\Http\Response
     */
    public function show(StudentPayment $studentPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentPayment  $studentPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentPayment $studentPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudentPayment  $studentPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentPayment $studentPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentPayment  $studentPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentPayment $studentPayment)
    {
        //
    }
}
