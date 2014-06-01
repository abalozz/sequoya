<?php

class Page extends Eloquent {
    
    protected $fillable = array('header_image', 'background_color',
                                'font_color', 'link_color');
    protected $timestamps = false;

    public function user()
    {
        return $this->belongsTo('User');
    }

}
