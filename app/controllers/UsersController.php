<?php

class UsersController extends BaseController {

    public function showProfile($username = null)
    {
        if (empty($username))
        {
            $user = Auth::user();
        }
        else
        {
            $user = User::where('username', '=', $username)->firstOrFail();
        }

        $publication = new Publication;
        $publications = $user->publications->reverse();

        return View::make('profile', compact('user',
                          'publication', 'publications'));
    }

    public function showEditProfile()
    {
        $user = Auth::user();
        return View::make('edit-profile', compact('user'));
    }

    public function updateProfile()
    {
        $user = Auth::user();
        $data = Input::all();

        if ($user->validAndSave($data))
        {
            return Redirect::back();
        }
        else
        {
            return Redirect::back()->withInput()->withErrors($user->errors);
        }
    }

    public function showFollowers($username = null)
    {
        $title = 'Seguidores';
        if (empty($username))
        {
            $empty_message = 'No tienes seguidores :(';
            $users = Auth::user()->followers;
        }
        else
        {
            $empty_message = 'No tiene seguidores :(';
            $users = User::where('username', '=', $username)
                ->first()->followers;
        }

        return View::make('user-list',
                          compact('users', 'title', 'empty_message'));
    }

    public function showFollowing($username = null)
    {
        $title = 'Siguiendo';
        if (empty($username))
        {
            $empty_message = 'No tienes seguidores :(';
            $users = Auth::user()->following;
        }
        else
        {
            $empty_message = 'No tiene seguidores :(';
            $users = User::where('username', '=', $username)
                ->first()->following;
        }
        return View::make('user-list',
                          compact('users', 'title', 'empty_message'));
    }

    public function follow($username)
    {
        $user = User::where('username', '=', $username)->firstOrFail();

        Auth::user()->follow($user);

        return Redirect::back();
    }

    public function unfollow($username)
    {
        $user = User::where('username', '=', $username)->firstOrFail();

        Auth::user()->unfollow($user);

        return Redirect::back();
    }

    public function search()
    {
        $search = Input::get('search');
        $title = 'Buscando ' . $search;
        $empty_message = 'No hemos encontrado coincidencias :(';
        $to_search = sprintf('%%%s%%', $search);

        $users = User::where('username', 'like', $to_search)
            ->orWhere('name', 'like', $to_search)->get();

        return View::make('user-list',
                          compact('users', 'title', 'empty_message', 'search'));
    }

    public function showDiscover()
    {
        $users = User::all();
        $count = $users->count();
        $users = $users->random(($count >= 8) ? 8 : $count);
        shuffle($users);
        $users = new Illuminate\Support\Collection($users);

        $title = 'Descubre';

        return View::make('user-list', compact('users', 'title'));
    }

}
