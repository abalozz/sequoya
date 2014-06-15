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

    public function discs()
    {
        return $this->hasMany('Disc');
    }

    public function songs()
    {
        return $this->hasManyThrough('Disc', 'Song');
    }

    public function followers()
    {
        return $this->belongsToMany('User',
                                    'follows',
                                    'user_followed_id',
                                    'user_who_follow_id');
    }

    public function following()
    {
        return $this->belongsToMany('User',
                                    'follows',
                                    'user_who_follow_id',
                                    'user_followed_id');
    }

    public function isFollowedBy($user)
    {
        return $this->followers->contains($user);
    }

    public function isFollowingTo($user)
    {
        return $this->following->contains($user);
    }

    public function follow($user)
    {
        if (!$this->isFollowingTo($user))
        {
            $follow = new Follow;
            $follow->user_who_follow_id = Auth::user()->id;
            $follow->user_followed_id = $user->id;
            $follow->save();
            
            return true;
        }

        return false;
    }

    public function unfollow($user)
    {
        if ($this->isFollowingTo($user))
        {
            $follow = Follow::where('user_who_follow_id', '=', Auth::user()->id)
                ->where('user_followed_id', '=', $user->id)->first();
            $follow->delete();
            
            return true;
        }

        return false;
    }

    public function getNameAttribute($value)
    {
        if (empty($value))
        {
            return $this->username;
        }
        return $value;
    }

    public function getAtUsernameAttribute()
    {
        return '@' . $this->username;
    }

    public function getNamedTypeAttribute()
    {
        return self::$types[$this->type];
    }

    public function getProfileImageUrlAttribute()
    {
        if ($this->profile_image)
        {
            return asset('uploads/profile-images/' . $this->profile_image);
        }
        else
        {
            return asset('img/default-profile-image.png');
        }
    }

    public function setPasswordAttribute($value)
    {
        if (!empty($value))
        {
            $this->attributes['password'] = Hash::make($value);
        }
    }

    public $errors;

    public function isValid($data)
    {
        $rules = array(
            'name' => '',
            'username' => 'required|alpha_dash|max:24|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'min:6',
            'description' => 'max:255',
            'profile_image' => 'image',
            'type' => 'required|between:0,2',
        );

        if ($this->exists)
        {
            $rules['username'] .= ',' . $this->id;
            $rules['email'] .= ',' . $this->id;
        }
        else
        {
            $rules['password'] .= '|required';
        }

        $validator = Validator::make($data, $rules);

        if ($validator->passes())
        {
            return true;
        }

        $this->errors = $validator->errors();

        return false;
    }

    public function validAndSave($data)
    {
        if ($this->isValid($data))
        {
            if (empty($data['profile_image']))
            {
                unset($data['profile_image']);
            }
            else
            {
                $profile_image = $data['profile_image'];
                $profile_image_name = sha1(
                    $this->id . microtime() .
                    $profile_image->getClientOriginalName()
                    ) . '.' . $profile_image->getClientOriginalExtension();
                $data['profile_image'] = $profile_image_name;
            }

            $this->fill($data);
            
            if ($this->save() && isset($profile_image))
            {
                $profile_image->move('public/uploads/profile-images',
                                     $profile_image_name);
            }

            return true;
        }

        return false;
    }

}
