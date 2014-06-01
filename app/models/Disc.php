<?php

class Disc extends Eloquent {

    protected $fillable = array('name', 'cover', 'release_date');
    protected $timestamps = false;

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function songs()
    {
        return $this->hasMany('Song');
    }

}
