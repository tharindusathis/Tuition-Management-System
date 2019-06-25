<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 03 Mar 2019 15:58:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Aclass
 * 
 * @property int $idclass
 * @property int $teacher_idteacher
 * @property int $hourly_rate
 * @property string $name
 * @property int $subject_idsubject
 * 
 * @property \App\Models\Subject $subject
 * @property \App\Models\Teacher $teacher
 * @property \Illuminate\Database\Eloquent\Collection $class_logs
 * @property \Illuminate\Database\Eloquent\Collection $enrolments
 * @property \Illuminate\Database\Eloquent\Collection $exams
 * @property \Illuminate\Database\Eloquent\Collection $timeslots
 *
 * @package App\Models
 */
class Aclass extends Eloquent
{
	protected $table = 'aclass';
	public $timestamps = false;

	protected $casts = [
		'teacher_idteacher' => 'int',
		'subject_idsubject' => 'int'
	];

	protected $fillable = [
		'hourly_rate',
		'name',
		'teacher_idteacher',
		'subject_idsubject',
		'institute_rate'
	];

	public function subject()
	{
		return $this->belongsTo(\App\Models\Subject::class, 'subject_idsubject');
	}

	public function teacher()
	{
		return $this->belongsTo(\App\Models\Teacher::class, 'teacher_idteacher');
	}

	public function class_logs()
	{
		return $this->hasMany(\App\Models\ClassLog::class, 'class_idclass');
	}

	public function enrolments()
	{
		return $this->hasMany(\App\Models\Enrolment::class, 'class_idclass');
	}

	public function exams()
	{
		return $this->hasMany(\App\Models\Exam::class, 'class_idclass');
	}

	public function timeslots()
	{
		return $this->hasMany(\App\Models\Timeslot::class, 'class_idclass');
	}
}
