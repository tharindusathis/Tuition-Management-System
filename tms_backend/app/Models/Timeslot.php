<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 04 Mar 2019 12:04:10 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Timeslot
 *
 * @property int $idtimeslot
 * @property int $class_idclass
 * @property int $hall_idhall
 * @property bool $weekday
 * @property \Carbon\Carbon $start_time
 * @property \Carbon\Carbon $end_time
 *
 * @property \App\Models\Aclass $aclass
 * @property \App\Models\Hall $hall
 * @property \Illuminate\Database\Eloquent\Collection $class_logs
 *
 * @package App\Models
 */
class Timeslot extends Eloquent
{
	protected $table = 'timeslot';
	public $timestamps = false;

	protected $casts = [
		'class_idclass' => 'int',
		'hall_idhall' => 'int',
		'weekday' => 'bool'
	];

	protected $dates = [
		//'start_time',
		//'end_time'
	];

	protected $fillable = [
		'weekday',
		'start_time',
		'end_time'
	];

	public function aclass()
	{
		return $this->belongsTo(\App\Models\Aclass::class, 'class_idclass');
	}

	public function hall()
	{
		return $this->belongsTo(\App\Models\Hall::class, 'hall_idhall');
	}

	public function class_logs()
	{
		return $this->hasMany(\App\Models\ClassLog::class, 'timeslot_idtimeslot');
	}
}
