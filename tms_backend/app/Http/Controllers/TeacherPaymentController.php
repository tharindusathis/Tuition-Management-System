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
    
    public function unpayed($id)
    { 
        $data = DB::select('
           SELECT
            class_log.idclass_log,
            aclass.idclass,
            aclass.idclass,
            aclass.`name`,
            aclass.hourly_rate,
            aclass.institute_rate,
            class_log.date,
            class_log.timeslot_idtimeslot AS idtimeslot,
            timeslot.start_time,
            timeslot.end_time,
            COUNT(attendance.student_idstudent) AS attendance_count,
            TIMESTAMPDIFF(MINUTE, timeslot.start_time, timeslot.end_time) AS timeslot_minutes,
            aclass.teacher_idteacher AS idteacher
            FROM
            class_log
            INNER JOIN aclass ON class_log.class_idclass = aclass.idclass
            INNER JOIN attendance ON attendance.class_log_idclass_log = class_log.idclass_log
            INNER JOIN timeslot ON timeslot.class_idclass = aclass.idclass AND class_log.timeslot_idtimeslot = timeslot.idtimeslot
            WHERE
            class_log.payed_to_teacher = 0 AND
            aclass.teacher_idteacher = ? AND
            attendance.state = 1
            GROUP BY
            idclass_log
        ', [$id]);

        foreach($data as $i){
            $hours = $i -> timeslot_minutes / 60;
           $i -> amount = $i-> hourly_rate * $hours  * $i -> attendance_count * (100 - $i -> institute_rate) / 100;
            $i -> commission = $i-> hourly_rate * $hours  * $i -> attendance_count * ($i -> institute_rate) / 100;
        }  
        return response()->json($data, 200);
    }

    
     public function set_payment($id)
    {
       DB::table('class_log')
        ->updateOrInsert(
            ['idclass_log' => $id],
            ['payed_to_teacher' => '1']
        ); 
        return response()->json("Done", 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        TeacherPayment::create($request->all());
        //set_payment($request->class_log_idclass_log);
        DB::table('class_log')
        ->updateOrInsert(
            ['idclass_log' => $request->class_log_idclass_log],
            ['payed_to_teacher' => '1']
        ); 
        return response()->json("Done", 200);
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
