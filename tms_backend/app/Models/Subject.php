<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 03 Mar 2019 15:58:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Subject
 * 
 * @property int $idsubject
 * @property string $name
 * @property string $grade
 * @property \Carbon\Carbon $syllabus_year
 * @property string $medium
 * 
 * @property \Illuminate\Database\Eloquent\Collection $aclasses
 *
 * @package App\Models
 */
class Subject extends Eloquent
{
	protected $table = 'subject';
	protected $primaryKey = 'idsubject';
	public $timestamps = false;

	protected $dates = [
		'syllabus_year'
	];

	protected $fillable = [
		'name',
		'grade',
		'syllabus_year',
		'medium'
	];

	public function aclasses()
	{
		return $this->hasMany(\App\Models\Aclass::class, 'subject_idsubject');
	}
}
