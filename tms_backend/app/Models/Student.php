<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 03 Mar 2019 15:58:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Student
 * 
 * @property int $idstudent
 * @property \Carbon\Carbon $dob
 * @property \Carbon\Carbon $join_date
 * @property string $contact_no
 * @property string $parent_name
 * @property string $parent_contatct_no
 * @property string $address
 * @property string $notes
 * @property string $fname
 * @property string $lname
 * @property string $full_name
 * 
 * @property \Illuminate\Database\Eloquent\Collection $attendances
 * @property \Illuminate\Database\Eloquent\Collection $enrolments
 * @property \Illuminate\Database\Eloquent\Collection $exams
 *
 * @package App\Models
 */
class Student extends Eloquent
{
	protected $table = 'student';
	protected $primaryKey = 'idstudent';
	public $timestamps = false;

	protected $dates = [
		'dob',
		'join_date'
	];

	protected $fillable = [
		'dob',
		'join_date',
		'contact_no',
		'parent_name',
		'parent_contact_no',
		'address',
		'notes',
		'fname',
		'lname',
		'full_name',
		'join_date'
	];

	public function attendances()
	{
		return $this->hasMany(\App\Models\Attendance::class, 'student_idstudent');
	}

	public function enrolments()
	{
		return $this->hasMany(\App\Models\Enrolment::class, 'student_idstudent');
	}

	public function exams()
	{
		return $this->belongsToMany(\App\Models\Exam::class, 'student_has_exam', 'student_idstudent', 'exam_idexam')
					->withPivot('marks', 'notes');
	}
}