<?php

namespace App\Http\Controllers;

use App\Models\Aclass;
use Illuminate\Http\Request;
use DB;

class AclassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$all = Aclass::all();
        $all = DB::select('
            SELECT
                aclass.idclass,
                aclass.hourly_rate,
                aclass.`name` AS class_name,
                `subject`.`name` AS subject_name,
                `subject`.`medium`,
                `subject`.grade,
                `subject`.syllabus_year,
                concat( teacher.fname, " ", teacher.lname ) AS teacher_name,
                teacher.join_date,
                teacher.idteacher,
                `subject`.idsubject
            FROM
                aclass
                LEFT OUTER JOIN `subject` ON aclass.subject_idsubject = `subject`.idsubject
                LEFT OUTER JOIN  teacher ON aclass.teacher_idteacher = teacher.idteacher
        ');
        foreach($all as $one){
            $medium = $one->medium;
            if($medium == "sin"){
                $one->medium = "Sinhala";
                //$one->_rowVariant = "danger";
                //$one->_cellVariants = array('medium'=>'warning');
            }else if($medium == "eng")
                $one->medium = "English";
            else if($medium == "tam")
                $one->medium = "Tamil";
        }
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

    public function add_student($id)
    {
        
    }
 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Aclass::create($request->all());//
    }


    public function oneClass($id)
        {

            $info = DB::select('
                SELECT
                aclass.idclass,
                aclass.hourly_rate,
                aclass.`name` AS class_name,
                aclass.institute_rate,
                concat( teacher.fname, " ", teacher.lname ) AS teacher_name,
                teacher.nic,
                teacher.idteacher,
                `subject`.`name` AS subject_name,
                `subject`.grade,
                `subject`.syllabus_year,
                `subject`.`medium`
                FROM
                aclass
                INNER JOIN teacher ON aclass.teacher_idteacher = teacher.idteacher
                INNER JOIN `subject` ON aclass.subject_idsubject = `subject`.idsubject
                WHERE
                aclass.idclass = ?
            ', [$id]);

            $timeslots = DB::select('
                           
            SELECT
            aclass.idclass,
            timeslot.idtimeslot,
            hall.idhall,
            hall.`name`,
            timeslot.weekday,
            timeslot.start_time,
            timeslot.end_time
            FROM
            aclass
            INNER JOIN timeslot ON timeslot.class_idclass = aclass.idclass
            INNER JOIN hall ON timeslot.hall_idhall = hall.idhall
            WHERE aclass.idclass = ?
            ', [$id]);

            $attendance = DB::select('
           SELECT
            attendance.state,
            attendance.payed_from_student,
            class_log.idclass_log,
            class_log.date,
            class_log.class_idclass,
            student.idstudent,
            student.full_name
            FROM
            class_log
            INNER JOIN attendance ON attendance.class_log_idclass_log = class_log.idclass_log
            INNER JOIN student ON attendance.student_idstudent = student.idstudent
            WHERE class_idclass = ?
            ', [$id]);
            
            $exams = DB::select('
           SELECT
            exam.`name` AS `exam_name`,    
            exam.idexam,
            exam.date_time,
            exam.duration,
            exam.class_idclass
            FROM
            exam
            WHERE class_idclass = ?
            ', [$id]);

            $class_logs = DB::select('
          SELECT
            timeslot.idtimeslot,
            hall.idhall,
            class_log.date,
            timeslot.start_time,
            timeslot.end_time,
            class_log.payed_to_teacher,
            class_log.idclass_log,
            class_log.class_idclass
            FROM
            class_log
            INNER JOIN timeslot ON class_log.timeslot_idtimeslot = timeslot.idtimeslot
            INNER JOIN hall ON timeslot.hall_idhall = hall.idhall
            WHERE class_log.class_idclass = ?
            ', [$id]);
            

            return response()->json(
                [
                    'info'=>$info,
                    'timeslots'=>$timeslots,
                    'attendance'=>$attendance,
                    'class_logs'=>$class_logs,
                    'exams'=>$exams,
                    
                ], 
            200);
        }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Aclass  $aclass
     * @return \Illuminate\Http\Response
     */
    public function show(Aclass $aclass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Aclass  $aclass
     * @return \Illuminate\Http\Response
     */
    public function edit(Aclass $aclass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Aclass  $aclass
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aclass $aclass)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Aclass  $aclass
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aclass $aclass)
    {
        //
    }
}
