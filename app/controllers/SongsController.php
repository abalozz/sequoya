<?php

class SongsController extends BaseController
{

    public function create($disc_id)
    {
        $disc = Disc::find($disc_id);
        $song = new Song;
        $data = Input::all();
        $data['disc_id'] = $disc->id;

        if ($song->validAndSave($data))
        {
            return Redirect::back();
        }
        else
        {
            return Redirect::back()->withInput()->withErrors($song->errors);
        }
    }

}
