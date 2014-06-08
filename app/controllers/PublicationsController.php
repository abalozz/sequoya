<?php

class PublicationsController extends BaseController
{

    public function publish()
    {
        $publication = new Publication();
        $data = Input::all();
        $data['user_id'] = Auth::user()->id;

        if ($publication->isValid($data))
        {
            $publication->fill($data);
            $publication->save();

            return Redirect::back();
        }
        else
        {
            return Redirect::back()->withInput()
                ->withErrors($publication->errors);
        }
    }

}
