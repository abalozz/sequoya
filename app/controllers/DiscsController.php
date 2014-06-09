<?php

class DiscsController extends BaseController
{

    public function showEditDiscs()
    {
        $user = Auth::user();
        $new_disc = new Disc;
        $new_song = new Song;

        return View::make('edit-discs', compact('user',
                          'new_disc', 'new_song'));
    }

    public function create()
    {
        $disc = new Disc;
        $data = Input::all();
        $data['user_id'] = Auth::user()->id;

        if ($disc->validAndSave($data))
        {
            return Redirect::back();
        }
        else
        {
            return Redirect::back()->withInput()->withErrors($disc->errors);
        }
    }

}
