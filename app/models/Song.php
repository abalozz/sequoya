<?php

class Song extends Eloquent {

    protected $fillable = array('disc_id', 'name', 'duration');
    public $timestamps = false;

    public function disc()
    {
        return $this->belongsTo('Disc');
    }

    public function user()
    {
        return $this->belongsTo('Disc', 'User');
    }

    public $errors;

    public function isValid($data)
    {
        $rules = array(
            'disc_id'     => 'required|integer',
            'name' => 'required',
            'duration'  => 'integer|min:0'
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
