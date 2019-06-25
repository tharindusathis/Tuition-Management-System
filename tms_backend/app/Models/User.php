<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 03 Mar 2019 15:58:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class User
 *
 * @property string $username
 * @property string $email
 * @property string $password
 * @property \Carbon\Carbon $created_at
 * @property int $type
 * @property int $state
 * @property int $used_id
 *
 * @package App\Models
 */
class User extends Eloquent
{
	protected $table = 'user';
	protected $primaryKey = 'username';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'type' => 'int',
		'state' => 'int',
		'user_id' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'email',
		'password',
		'type',
		'state',
		'user_id'
	];
}
