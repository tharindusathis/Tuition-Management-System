<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 03 Mar 2019 15:58:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Enrolment
 * 
 * @property int $student_idstudent
 * @property int $class_idclass
 * @property \Carbon\Carbon $date_joined
 * 
 * @property \App\Models\Aclass $aclass
 * @property \App\Models\Student $student
 *
 * @package App\Models
 */
class Enrolment extends Eloquent
{
	protected $table = 'enrolment';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'student_idstudent' => 'int',
		'class_idclass' => 'int'
	];

	protected $dates = [
		'date_joined'
	];

	protected $fillable = [
		'date_joined'
	];

	public function aclass()
	{
		return $this->belongsTo(\App\Models\Aclass::class, 'class_idclass');
	}

	public function student()
	{
		return $this->belongsTo(\App\Models\Student::class, 'student_idstudent');
	}
}
