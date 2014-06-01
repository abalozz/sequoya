<?php

class Song extends Eloquent {

    protected $fillable = array('name', 'duration');
    protected $timestamps = false;

    public function disc()
    {
        return $this->belongsTo('Disc');
    }

    public function user()
    {
        return $this->belongsTo('Disc', 'User');
    }

}
