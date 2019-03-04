<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 03 Mar 2019 15:58:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TeacherPayment
 * 
 * @property int $idteacher_payment
 * @property int $admin_idadmin
 * @property \Carbon\Carbon $issue_date
 * @property \Carbon\Carbon $update_time
 * 
 * @property \App\Models\Admin $admin
 * @property \Illuminate\Database\Eloquent\Collection $class_logs
 *
 * @package App\Models
 */
class TeacherPayment extends Eloquent
{
	protected $table = 'teacher_payment';
	public $timestamps = false;

	protected $casts = [
		'admin_idadmin' => 'int'
	];

	protected $dates = [
		'issue_date',
		'update_time'
	];

	protected $fillable = [
		'issue_date',
		'update_time'
	];

	public function admin()
	{
		return $this->belongsTo(\App\Models\Admin::class, 'admin_idadmin');
	}

	public function class_logs()
	{
		return $this->hasMany(\App\Models\ClassLog::class, 'teacher_payment_idteacher_payment');
	}
}
