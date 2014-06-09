<?php

class Page extends Eloquent {
    
    protected $fillable = array('header_image', 'background_color',
                                'font_color', 'link_color', 'subdomain',
                                'user_id');
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('User');
    }

    public $errors;

    public function isValid($data)
    {
        $rules = array(
            'user_id'     => 'required|integer|unique:pages,user_id',
            'subdomain' => 'required|alpha_dash',
            'header_image' => '',
            'background_color'  => '',
            'font_color'  => '',
            'link_color'  => ''
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
