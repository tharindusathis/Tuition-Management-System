<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 04 Mar 2019 14:17:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class StudentPayment
 * 
 * @property int $idstudent_payment
 * @property int $admin_idadmin
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $issue_date
 * @property int $amount
 * 
 * @property \App\Models\Admin $admin
 * @property \Illuminate\Database\Eloquent\Collection $attendances
 *
 * @package App\Models
 */
class StudentPayment extends Eloquent
{
	protected $table = 'student_payment';
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
		'amount',
        'admin_idadmin'
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
