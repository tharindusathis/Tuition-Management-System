<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 04 Mar 2019 14:17:25 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TeacherPayment
 *
 * @property int $idteacher_payment
 * @property int $admin_idadmin
 * @property \Carbon\Carbon $issue_date
 * @property \Carbon\Carbon $updated_at
 * @property int $amount
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
		'admin_idadmin' => 'int',
		'amount' => 'int'
	];

	protected $dates = [
		'issue_date'
	];

	protected $fillable = [
		'issue_date',
        'admin_idadmin' ,
        'class_log_idclass_log',
		'amount'
	];

	public function admin()
	{
		return $this->belongsTo(\App\Models\Admin::class, 'admin_idadmin');
	}

	public function class_logs()
	{
		return $this->belongsTo(\App\Models\ClassLog::class, 'teacher_payment_idteacher_payment');
	}
}
