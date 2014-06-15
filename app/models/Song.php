<?php

class Song extends Eloquent {

    protected $fillable = array('disc_id', 'name', 'duration',
                                'track', 'number');
    public $timestamps = false;

    public function disc()
    {
        return $this->belongsTo('Disc');
    }

    public function user()
    {
        return $this->belongsTo('Disc', 'User');
    }

    public function getTrackUrlAttribute()
    {
        if ($this->track)
        {
            return asset('uploads/songs/' . $this->track);
        }

        return null;
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
            if (empty($data['track']))
            {
                unset($data['track']);
            }
            else
            {
                $track = $data['track'];
                $track_name = sha1(
                    $this->id . microtime() .
                    $track->getClientOriginalName()
                    ) . '.' . $track->getClientOriginalExtension();
            }

            $this->fill($data);

            if ($this->save() && isset($track))
            {
                $track->move('public/uploads/songs', $track_name);
            }
            
            return true;
        }
        
        return false;
    }

}
