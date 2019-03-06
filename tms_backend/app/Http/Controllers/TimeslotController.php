<?php

namespace App\Http\Controllers;

use App\Models\Timeslot;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
       $all = Timeslot::all();
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
