<?php

namespace App\Http\Controllers;

use App\Models\Timeslot;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class TimeslotController extends Controller
{
    public function getStartTimeAttribute($value)
    {
        $this->attributes['start_time'] = Carbon\Carbon::createFromFormat('h:i:s', $value);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = DB::select('
            SELECT
                timeslot.idtimeslot,
                timeslot.weekday,
                timeslot.start_time,
                timeslot.end_time,
                hall.`name` AS hall_name,
                hall.idhall,
                aclass.idclass,
                aclass.`name` AS class_name,
                `subject`.`name` AS subject_name,
                `subject`.idsubject,
                `subject`.grade,
                aclass.hourly_rate
            FROM
                timeslot
                LEFT OUTER JOIN hall ON timeslot.hall_idhall = hall.idhall
                LEFT OUTER JOIN aclass ON timeslot.class_idclass = aclass.idclass
                LEFT OUTER JOIN `subject` ON aclass.subject_idsubject = `subject`.idsubject
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
     * @param  \App\Models\Timeslot  $timeslot
     * @return \Illuminate\Http\Response
     */
    public function show(Timeslot $timeslot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Timeslot  $timeslot
     * @return \Illuminate\Http\Response
     */
    public function edit(Timeslot $timeslot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Timeslot  $timeslot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Timeslot $timeslot)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Timeslot  $timeslot
     * @return \Illuminate\Http\Response
     */
    public function destroy(Timeslot $timeslot)
    {
        //
    }
}
