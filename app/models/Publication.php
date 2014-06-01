<?php

class Publication extends Eloquent {
    
    protected $fillable = array('content');

    public function user()
    {
        return $this->belongsTo('User');
    }

}
