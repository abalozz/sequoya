<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	protected $fillable = array('name', 'username', 'email', 'description',
	                            'profile_image', 'type');

	public $user_types = array('Usuario', 'Artista independiente',
	                            'Grupo/Banda');

	public function page()
	{
		return $this->hasOne('Page');
	}

	public function publications()
	{
		return $this->hasMany('Publication');
	}

	public function songs()
	{
		return $this->hasManyThrough('Disc', 'Song');
	}

	public function getTypeAttribute($value)
	{
		return $this->user_types[$value];
	}

}
