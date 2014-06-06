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

    protected $fillable = array('name', 'username', 'email', 'password',
                                'description', 'profile_image', 'type');

    static $types = array('Usuario', 'Artista independiente',
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

    public function getNamedTypeAttribute($value)
    {
        return self::$types[$value];
    }

    public $errors;

    public function isValid($data)
    {
        $rules = array(
            'name' => '',
            'username' => 'required|alpha_dash|max:24|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'description' => 'max:255',
            'profile_image' => 'image',
            'type' => 'required|between:0,2',
        );

        $validator = Validator::make($data, $rules);

        if ($validator->passes())
        {
            return true;
        }

        $this->errors = $validator->errors();

        return false;
    }

}
