<?php

class Publication extends Eloquent {
    
    protected $fillable = array('content', 'user_id');

    public function user()
    {
        return $this->belongsTo('User');
    }

    public $errors;

    public function isValid($data)
    {
        $rules = array(
            'user_id' => 'integer|required',
            'content' => 'required',
        );

        $validator = Validator::make($data, $rules);

        if ($validator->passes())
        {
            return true;
        }

        $this->errors = $validator->errors();

        return false;
    }

    public function scopeFromFollowingsOf($query, $user)
    {
        $query->where('user_id', '=', $user->id);
        $user->following->each(function(User $follow) use (&$query)
        {
            $query->orWhere('user_id', '=', $follow->id);
        });

        return $query;
    }

}
