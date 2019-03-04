<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 03 Mar 2019 15:58:36 +0000.
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
 * @property int $duration
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
		'weekday' => 'bool',
		'duration' => 'int'
	];

	protected $fillable = [
		'weekday',
		'duration'
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
