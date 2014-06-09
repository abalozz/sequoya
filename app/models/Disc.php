<?php

class Disc extends Eloquent {

    protected $fillable = array('user_id', 'name', 'cover', 'release_date');
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function songs()
    {
        return $this->hasMany('Song');
    }

    public $errors;

    public function isValid($data)
    {
        $rules = array(
            'user_id'     => 'required|integer',
            'name' => 'required',
            'cover'  => '',
            'release_date'  => 'date'
        );
        
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
            $this->fill($data);
            $this->save();
            
            return true;
        }
        
        return false;
    }

}
