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

    public function getHeaderImageUrlAttribute()
    {
        if ($this->header_image)
        {
            return asset('uploads/header-images/' . $this->header_image);
        }

        return null;
    }

    public $errors;

    public function isValid($data)
    {
        $rules = array(
            'user_id'     => 'integer|unique:pages,user_id',
            'subdomain' => 'required|alpha_dash',
            'header_image' => '',
            'background_color'  => '',
            'font_color'  => '',
            'link_color'  => ''
        );
        
        $validator = Validator::make($data, $rules);

        if ($this->exists)
        {
            $rules['user_id'] .= ',' . $this->id;
        }
        
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
            if (empty($data['header_image']))
            {
                unset($data['header_image']);
            }
            else
            {
                $header_image = $data['header_image'];
                $header_image_name = sha1(
                    $this->id . microtime() .
                    $header_image->getClientOriginalName()
                    ) . '.' . $header_image->getClientOriginalExtension();
                $data['header_image'] = $header_image_name;
            }

            $this->fill($data);
            
            if ($this->save() && isset($header_image))
            {
                $header_image->move('public/uploads/header-images',
                                     $header_image_name);
            }

            return true;
        }

        return false;
    }

}
