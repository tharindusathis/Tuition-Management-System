<?php

namespace App\Http\Controllers;

use App\Models\ClassLog;
use Illuminate\Http\Request;
use DB;

class ClassLogController extends Controller
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
                aclass.idclass,
                timeslot.idtimeslot,
                hall.idhall,
                hall.`name` AS hall_name,
                class_log.date,
                class_log.payed_to_teacher,
                timeslot.start_time,
                timeslot.end_time,
                aclass.`name` AS class_name,
                `subject`.`name` AS subject_name,
                `subject`.idsubject,
                `subject`.grade,
                `subject`.`medium`,
                aclass.hourly_rate,
                timeslot.weekday,
                teacher_payment.idteacher_payment,
                teacher_payment.amount,
                teacher_payment.issue_date,
                Count( attendance.class_log_idclass_log ) AS attendace_count,
                Count( attendance.student_payment_idstudent_payment ) AS student_payed_count
            FROM
                class_log
                LEFT OUTER JOIN aclass ON class_log.class_idclass = aclass.idclass
                LEFT OUTER JOIN timeslot ON timeslot.class_idclass = aclass.idclass
                AND class_log.timeslot_idtimeslot = timeslot.idtimeslot
                LEFT OUTER JOIN hall ON timeslot.hall_idhall = hall.idhall
                LEFT OUTER JOIN `subject` ON aclass.subject_idsubject = `subject`.idsubject
                LEFT OUTER JOIN teacher_payment ON teacher_payment.class_log_idclass_log = class_log.idclass_log
                INNER JOIN attendance ON attendance.class_log_idclass_log = class_log.idclass_log
            GROUP BY
                class_log.idclass_log,
                aclass.idclass,
                timeslot.idtimeslot,
                hall.idhall,
                hall.`name`,
                class_log.date,
                class_log.payed_to_teacher,
                timeslot.start_time,
                timeslot.end_time,
                aclass.`name`,
                `subject`.`name`,
                `subject`.idsubject,
                `subject`.grade,
                `subject`.`medium`,
                aclass.hourly_rate,
                timeslot.weekday,
                teacher_payment.idteacher_payment,
                teacher_payment.amount,
                teacher_payment.issue_date
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
        return ClassLog::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClassLog  $classLog
     * @return \Illuminate\Http\Response
     */
    public function show(ClassLog $classLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClassLog  $classLog
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassLog $classLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClassLog  $classLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClassLog $classLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClassLog  $classLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassLog $classLog)
    {
        //
    }
}
