<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 03 Mar 2019 15:58:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Exam
 * 
 * @property int $idexam
 * @property string $name
 * @property \Carbon\Carbon $date_time
 * @property int $duration
 * @property int $class_idclass
 * 
 * @property \App\Models\Aclass $aclass
 * @property \Illuminate\Database\Eloquent\Collection $students
 *
 * @package App\Models
 */
class Exam extends Eloquent
{
	protected $table = 'exam';
	public $timestamps = false;

	protected $casts = [
		'duration' => 'int',
		'class_idclass' => 'int'
	];

	protected $dates = [
		'date_time'
	];

	protected $fillable = [
		'name',
		'date_time',
		'duration'
	];

	public function aclass()
	{
		return $this->belongsTo(\App\Models\Aclass::class, 'class_idclass');
	}

	public function students()
	{
		return $this->belongsToMany(\App\Models\Student::class, 'student_has_exam', 'exam_idexam', 'student_idstudent')
					->withPivot('marks', 'notes');
	}
}
