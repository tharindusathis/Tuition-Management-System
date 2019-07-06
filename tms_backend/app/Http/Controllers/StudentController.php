<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class StudentController extends Controller
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
                student.idstudent,
                student.join_date,
                student.contact_no,
                student.parent_name,
                student.parent_contact_no,
                concat(student.fname, " ", student.lname) AS student_name,
                student.dob,
                student.address,
                student.notes,
                student.full_name
            FROM
                student
        ');
        return response()->json(['all'=>$all], 200);
    }

    public function index_min()
    {
        $all = DB::select('
            SELECT
                student.idstudent, 
                concat(student.fname, " ", student.lname) AS student_name,
                student.full_name
            FROM
                student
        ');
        return response()->json(['all'=>$all], 200);
    }

    public function inClass($id)
    {
        $in = DB::select('
            SELECT
            student.idstudent,
            student.join_date,
            student.contact_no,
            student.parent_name,
            student.parent_contact_no,
            concat(student.fname, " ", student.lname) AS student_name,
            student.dob,
            student.address,
            student.notes,
            student.full_name,
            enrolment.date_joined,
            enrolment.class_idclass
            FROM
            student
            INNER JOIN enrolment ON enrolment.student_idstudent = student.idstudent
            WHERE
            class_idclass = ?
        ', [$id]);
        return response()->json($in, 200);
    }


    public function notInClass($id)
    { 

        $notIn = DB::select('
            SELECT
            student.idstudent,
            student.join_date,
            student.contact_no,
            student.parent_name,
            student.parent_contact_no,
            concat(student.fname, " ", student.lname) AS student_name,
            student.dob,
            student.address,
            student.notes,
            student.full_name,
            enrolment.date_joined,
            enrolment.class_idclass
            FROM
            student
            INNER JOIN enrolment ON enrolment.student_idstudent = student.idstudent
            WHERE
            class_idclass != ?
        ', [$id]);
        return response()->json($notIn, 200);
    }

    public function unpayed($id)
    { 
        $data = DB::select('
            SELECT
            student.idstudent,
            student.full_name,
            attendance.class_log_idclass_log,
            aclass.hourly_rate,
            aclass.`name` AS `  class_name`,
            class_log.date,
            class_log.hours, 
            TIMESTAMPDIFF(MINUTE, timeslot.start_time, timeslot.end_time) AS timeslot_minutes
            FROM
            attendance
            INNER JOIN student ON attendance.student_idstudent = student.idstudent
            INNER JOIN class_log ON attendance.class_log_idclass_log = class_log.idclass_log
            INNER JOIN aclass ON class_log.class_idclass = aclass.idclass
            INNER JOIN timeslot ON class_log.timeslot_idtimeslot = timeslot.idtimeslot
            WHERE
            attendance.state = 1 AND
            attendance.payed_from_student = 0 
            AND
            attendance.student_idstudent = ?
        ', [$id]);

        foreach($data as $i){
           $i->amount = $i-> hourly_rate * $i -> timeslot_minutes / 60;
        }
        

        return response()->json($data, 200);
    }
    
    public function pay(Request $request)
    {
        $join_date = Carbon::now()->toDateString(); 
        $idStudent = $request->idStudent;
        $idStudentPayment = $request->student_payment_idstudent_payment;
        $str = "hi";
        foreach($request->idLogs as $idLog){
           DB::table('attendance')
            ->updateOrInsert(
                ['student_idstudent' => $idStudent, 'class_log_idclass_log' => $idLog],
                ['payed_from_student' => '1', 'student_payment_idstudent_payment' => $idStudentPayment]
            );
        }
        return response()->json("Done", 200);
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
        $join_date = Carbon::now()->toDateString();
        $request['join_date'] = $join_date;
        return Student::create($request->all());
    }


    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }


    public function oneClass($id)
        {

            $info = DB::select('
               SELECT
                student.idstudent,
                student.dob,
                student.join_date,
                student.contact_no,
                student.parent_name,
                student.parent_contact_no,
                student.address,
                student.notes,
                student.fname,
                student.lname,
                student.full_name
                FROM
                student
                WHERE student.idstudent = ?
            ', [$id]);

            $classes = DB::select('
             SELECT
                aclass.idclass,
                aclass.`name`,
                enrolment.date_joined
                FROM
                enrolment
                INNER JOIN aclass ON enrolment.class_idclass = aclass.idclass
                WHERE
                enrolment.student_idstudent = ?

            ', [$id]);
            
            $exams = DB::select('
            SELECT
            student_has_exam.marks,
            student_has_exam.notes,
            exam.duration,
            exam.date_time,
            exam.`name`,
            exam.idexam,
            aclass.`name`,
            aclass.idclass,
            student_has_exam.student_idstudent
            FROM
            student_has_exam
            INNER JOIN exam ON student_has_exam.exam_idexam = exam.idexam
            INNER JOIN aclass ON exam.class_idclass = aclass.idclass
            WHERE student_has_exam.student_idstudent = ?
            ', [$id]);

            $payments = DB::select('
            SELECT
            student_payment.admin_idadmin,
            student_payment.updated_at,
            student_payment.amount,
            student_payment.student_idstudent
            FROM
            student_payment
            WHERE student_payment.student_idstudent = ?
            ', [$id]);

            $attendance = DB::select('
             SELECT
            aclass.idclass,
            class_log.idclass_log,
            aclass.`name`,
            attendance.state,
            class_log.date
            FROM
            attendance
            INNER JOIN class_log ON attendance.class_log_idclass_log = class_log.idclass_log
            INNER JOIN aclass ON class_log.class_idclass = aclass.idclass
            WHERE
            attendance.student_idstudent = ?
            ', [$id]);

            $payed = DB::select('
            SELECT
            attendance.state,
            attendance.student_payment_idstudent_payment,
            class_log.class_idclass,
            class_log.date,
            class_log.idclass_log,
            aclass.`name`
            FROM
            attendance
            INNER JOIN class_log ON attendance.class_log_idclass_log = class_log.idclass_log
            INNER JOIN aclass ON class_log.class_idclass = aclass.idclass
            WHERE
            attendance.state = 1 AND
            attendance.payed_from_student = 1 AND
            attendance.student_idstudent = ?
            ORDER BY date
            ', [$id]);

            $unpayed = DB::select('
            SELECT 
            class_log.class_idclass,
            class_log.date,
            class_log.idclass_log,
            aclass.`name`
            FROM
            attendance
            INNER JOIN class_log ON attendance.class_log_idclass_log = class_log.idclass_log
            INNER JOIN aclass ON class_log.class_idclass = aclass.idclass
            WHERE
            attendance.state = 1 AND
            attendance.payed_from_student = 0 AND
            attendance.student_idstudent = ?
            ORDER BY date

            ', [$id]);
            

            return response()->json(
                [
                    'info'=>$info,
                    'classes'=>$classes,
                    'attendance'=>$attendance,
                    'payments'=>$payments,
                    'exams'=>$exams,
                    'payed'=>$payed,
                    'unpayed'=>$unpayed
                    
                ], 
            200);
        }
}
