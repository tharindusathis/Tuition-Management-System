<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;
use DB;

class ExamController extends Controller
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
                exam.idexam,
                exam.`name` AS exam_name,
                exam.date_time,
                exam.duration,
                aclass.idclass,
                `subject`.idsubject,
                `subject`.`name` AS subject_name,
                `subject`.grade,
                `subject`.`medium`,
                aclass.`name` AS class_name,
                teacher.idteacher,
                concat( teacher.fname, " ", teacher.lname ) AS teacher_name
            FROM
                exam
                LEFT OUTER JOIN aclass ON exam.class_idclass = aclass.idclass
                LEFT OUTER JOIN `subject` ON aclass.subject_idsubject = `subject`.idsubject
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
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exam $exam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        //
    }
}
