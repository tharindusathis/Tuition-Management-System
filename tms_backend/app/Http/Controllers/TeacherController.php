<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       $all = DB::Select('
            SELECT
                teacher.idteacher,
                concat( teacher.fname, " ", teacher.lname ) AS teacher_name,
                teacher.nic,
                teacher.join_date,
                Count( aclass.idclass ) AS `class_count`,
                Avg( aclass.hourly_rate ) AS `avg_rate`
            FROM
                teacher
                LEFT OUTER JOIN aclass ON aclass.teacher_idteacher = teacher.idteacher
            GROUP BY
                teacher.idteacher,
                teacher.nic,
                teacher.join_date
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
        $join_date = Carbon::now()->toDateString();
        $request['join_date'] = $join_date;
        return Teacher::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        //
    }
}
