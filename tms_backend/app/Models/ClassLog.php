<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 03 Mar 2019 15:58:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ClassLog
 * 
 * @property int $idclass_log
 * @property int $class_idclass
 * @property int $timeslot_idtimeslot
 * @property \Carbon\Carbon $date
 * @property int $teacher_payment_idteacher_payment
 * @property int $payed_to_teacher
 * 
 * @property \App\Models\Aclass $aclass
 * @property \App\Models\TeacherPayment $teacher_payment
 * @property \App\Models\Timeslot $timeslot
 * @property \Illuminate\Database\Eloquent\Collection $attendances
 *
 * @package App\Models
 */
class ClassLog extends Eloquent
{
	protected $table = 'class_log';
	public $timestamps = false;

	protected $casts = [
		'class_idclass' => 'int',
		'timeslot_idtimeslot' => 'int',
		'teacher_payment_idteacher_payment' => 'int',
		'payed_to_teacher' => 'int'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'date',
		'teacher_payment_idteacher_payment',
		'payed_to_teacher'
	];

	public function aclass()
	{
		return $this->belongsTo(\App\Models\Aclass::class, 'class_idclass');
	}

	public function teacher_payment()
	{
		return $this->belongsTo(\App\Models\TeacherPayment::class, 'teacher_payment_idteacher_payment');
	}

	public function timeslot()
	{
		return $this->belongsTo(\App\Models\Timeslot::class, 'timeslot_idtimeslot');
	}

	public function attendances()
	{
		return $this->hasMany(\App\Models\Attendance::class, 'class_log_idclass_log');
	}
}
