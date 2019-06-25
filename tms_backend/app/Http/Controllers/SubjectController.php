<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use DB;

class SubjectController extends Controller
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
                `subject`.idsubject,
                `subject`.`name` AS subject_name,
                `subject`.grade,
                `subject`.syllabus_year,
                `subject`.`medium`,
                Count( aclass.subject_idsubject ) AS class_count,
                Avg( aclass.hourly_rate ) AS avg_rate
            FROM
                `subject`
                LEFT OUTER JOIN aclass ON aclass.subject_idsubject = `subject`.idsubject
            GROUP BY
                `subject`.idsubject,
                `subject`.`name`,
                `subject`.grade,
                `subject`.syllabus_year,
                `subject`.`medium`
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
        return Subject::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        //
    }
}
