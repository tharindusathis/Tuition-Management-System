<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 03 Mar 2019 15:58:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Teacher
 * 
 * @property int $idteacher
 * @property string $fname
 * @property string $lname
 * @property string $nic
 * @property \Carbon\Carbon $join_date
 * 
 * @property \Illuminate\Database\Eloquent\Collection $aclasses
 *
 * @package App\Models
 */
class Teacher extends Eloquent
{
	protected $table = 'teacher';
	protected $primaryKey = 'idteacher';
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

	public function aclasses()
	{
		return $this->hasMany(\App\Models\Aclass::class, 'teacher_idteacher');
	}
}
