<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 03 Mar 2019 15:58:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Hall
 * 
 * @property int $idhall
 * @property string $name
 * @property string $note
 * 
 * @property \Illuminate\Database\Eloquent\Collection $timeslots
 *
 * @package App\Models
 */
class Hall extends Eloquent
{
	protected $table = 'hall';
	protected $primaryKey = 'idhall';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'note'
	];

	public function timeslots()
	{
		return $this->hasMany(\App\Models\Timeslot::class, 'hall_idhall');
	}
}
