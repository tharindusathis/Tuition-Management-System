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
