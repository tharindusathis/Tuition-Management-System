<?php

namespace App\Http\Controllers;

use App\Models\StudentHasExam;
use Illuminate\Http\Request;

class StudentHasExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $all = StudentHasExam::all();
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
     * @param  \App\Models\StudentHasExam  $studentHasExam
     * @return \Illuminate\Http\Response
     */
    public function show(StudentHasExam $studentHasExam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentHasExam  $studentHasExam
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentHasExam $studentHasExam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudentHasExam  $studentHasExam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentHasExam $studentHasExam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentHasExam  $studentHasExam
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentHasExam $studentHasExam)
    {
        //
    }
}
