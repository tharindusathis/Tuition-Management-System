<?php

namespace App\Http\Controllers;

use App\Models\StudentPayment;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class StudentPaymentController extends Controller
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
            student.idstudent,
            student_payment.admin_idadmin,
            concat( admin.fname, " ", admin.lname ) AS admin_name,
            concat( student.fname, " ", student.lname ) AS student_name,
            student_payment.idstudent_payment,
            student_payment.updated_at,
            student_payment.amount,
            admin.idadmin
            FROM
            student_payment
            INNER JOIN student ON student_payment.student_idstudent = student.idstudent
            INNER JOIN admin ON student_payment.admin_idadmin = admin.idadmin

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
        //$date = Carbon::now()->toDateString();
        //$request['issue_date'] = $date;
        return StudentPayment::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudentPayment  $studentPayment
     * @return \Illuminate\Http\Response
     */
    public function show(StudentPayment $studentPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentPayment  $studentPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentPayment $studentPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudentPayment  $studentPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentPayment $studentPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentPayment  $studentPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentPayment $studentPayment)
    {
        //
    }
}
