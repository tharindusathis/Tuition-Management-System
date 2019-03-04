<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 03 Mar 2019 15:58:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class StudentPayment
 * 
 * @property int $idstudent_payment
 * @property int $admin_idadmin
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Admin $admin
 * @property \Illuminate\Database\Eloquent\Collection $attendances
 *
 * @package App\Models
 */
class StudentPayment extends Eloquent
{
	protected $table = 'student_payment';

	protected $casts = [
		'admin_idadmin' => 'int'
	];

	public function admin()
	{
		return $this->belongsTo(\App\Models\Admin::class, 'admin_idadmin');
	}

	public function attendances()
	{
		return $this->hasMany(\App\Models\Attendance::class, 'student_payment_idstudent_payment');
	}
}
