<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 04 Mar 2019 13:47:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Attendance
 * 
 * @property int $student_idstudent
 * @property int $class_log_idclass_log
 * @property int $state
 * @property int $student_payment_idstudent_payment
 * @property int $payed_from_student
 * 
 * @property \App\Models\ClassLog $class_log
 * @property \App\Models\Student $student
 * @property \App\Models\StudentPayment $student_payment
 *
 * @package App\Models
 */
class Attendance extends Eloquent
{
	protected $table = 'attendance';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'student_idstudent' => 'int',
		'class_log_idclass_log' => 'int',
		'state' => 'int',
		'student_payment_idstudent_payment' => 'int',
		'payed_from_student' => 'int'
	];

	protected $fillable = [
		'state',
		'student_payment_idstudent_payment',
		'payed_from_student'
	];

	public function class_log()
	{
		return $this->belongsTo(\App\Models\ClassLog::class, 'class_log_idclass_log');
	}

	public function student()
	{
		return $this->belongsTo(\App\Models\Student::class, 'student_idstudent');
	}

	public function student_payment()
	{
		return $this->belongsTo(\App\Models\StudentPayment::class, 'student_payment_idstudent_payment');
	}
}
