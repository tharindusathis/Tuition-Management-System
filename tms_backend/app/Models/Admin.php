<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 03 Mar 2019 15:58:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Admin
 * 
 * @property int $idadmin
 * @property string $fname
 * @property string $lname
 * @property string $nic
 * @property \Carbon\Carbon $join_date
 * 
 * @property \Illuminate\Database\Eloquent\Collection $student_payments
 * @property \Illuminate\Database\Eloquent\Collection $teacher_payments
 *
 * @package App\Models
 */
class Admin extends Eloquent
{
	protected $table = 'admin';
	protected $primaryKey = 'idadmin';
	public $timestamps = false;

	protected $dates = [
		'join_date'
	];

	protected $fillable = [
		'fname',
		'lname',
		'nic',
		'join_date'
	];

	public function student_payments()
	{
		return $this->hasMany(\App\Models\StudentPayment::class, 'admin_idadmin');
	}

	public function teacher_payments()
	{
		return $this->hasMany(\App\Models\TeacherPayment::class, 'admin_idadmin');
	}
}
