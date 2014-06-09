<?php

class PagesController extends BaseController
{

    public function showEditPage()
    {
        if (Auth::user()->page)
        {
            $page = Auth::user()->page;
        }
        else
        {
            $page = new Page;
        }

        return View::make('edit-page', compact('page'));
    }

    public function showPage($subdomain)
    {
        $page = Page::where('subdomain', '=', $subdomain)->firstOrFail();

        return View::make('page', compact('page'));

    }

    public function create()
    {
        $page = new Page;
        $data = Input::all();
        $data['user_id'] = Auth::user()->id;

        if ($page->validAndSave($data))
        {
            return Redirect::back();
        }
        else
        {
            return Redirect::back()->withInput()->withErrors($page->errors);
        }
    }

    public function update()
    {
        $page = Auth::user()->page;
        $data = Input::all();

        if ($page->validAndSave($data))
        {
            return Redirect::back();
        }
        else
        {
            return Redirect::back()->withInput()->withErrors($page->errors);
        }
    }

}
