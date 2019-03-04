<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 03 Mar 2019 15:58:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class StudentHasExam
 * 
 * @property int $student_idstudent
 * @property int $exam_idexam
 * @property int $marks
 * @property string $notes
 * 
 * @property \App\Models\Exam $exam
 * @property \App\Models\Student $student
 *
 * @package App\Models
 */
class StudentHasExam extends Eloquent
{
	protected $table = 'student_has_exam';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'student_idstudent' => 'int',
		'exam_idexam' => 'int',
		'marks' => 'int'
	];

	protected $fillable = [
		'marks',
		'notes'
	];

	public function exam()
	{
		return $this->belongsTo(\App\Models\Exam::class, 'exam_idexam');
	}

	public function student()
	{
		return $this->belongsTo(\App\Models\Student::class, 'student_idstudent');
	}
}
