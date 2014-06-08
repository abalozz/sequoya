<?php

class HomeController extends BaseController {

    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |   Route::get('/', 'HomeController@showWelcome');
    |
    */

    public function showIndex()
    {
        $user = Auth::user();
        $publication = new Publication;
        $publications = Publication::fromFollowingsOf(Auth::user())
            ->orderBy('created_at', 'desc')->get();

        return View::make('index', compact('user',
                          'publication','publications'));
    }

    public function showLanding()
    {
        return View::make('landing/index');
    }

    public function showSignUp()
    {
        $user = new User;
        return View::make('landing/sign-up', compact('user'));
    }

    public function login()
    {
        if (Auth::attempt(array('username' => Input::get('username'),
                                'password' => Input::get('password'))))
        {
            return Redirect::action('HomeController@showIndex');
        }
        return Redirect::action('HomeController@showLanding')
            ->withInput()
            ->withErrors(array('Los datos introducidos no son correctos'));
    }

    public function logout()
    {
        Auth::logout();
        return Redirect::action('HomeController@showLanding');
    }

    public function signUp()
    {
        $user = new User;
        $data = Input::all();

        if ($user->isValid($data)) {
            $user->fill($data);
            $user->save();
            
            return $this->login();
        } else {
            return Redirect::action('HomeController@showSignUp')
                ->withInput()->withErrors($user->errors);
        }
    }

}
