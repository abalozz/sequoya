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

    public function getCoverUrlAttribute()
    {
        if ($this->cover)
        {
            return asset('uploads/cover-images/' . $this->cover);
        }
        else
        {
            return asset('img/default-cover-image.png');
        }
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
            if (empty($data['cover']))
            {
                unset($data['cover']);
            }
            else
            {
                $cover = $data['cover'];
                $cover_name = sha1(
                    $this->id . microtime() .
                    $cover->getClientOriginalName()
                    ) . '.' . $cover->getClientOriginalExtension();
                $data['cover'] = $cover_name;
            }

            $this->fill($data);

            if ($this->save() && isset($cover))
            {
                $cover->move('public/uploads/cover-images', $cover_name);
            }
            
            return true;
        }
        
        return false;
    }

}
