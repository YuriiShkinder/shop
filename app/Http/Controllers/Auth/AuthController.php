<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Validator;
use App\Http\Controllers\Controller;

use Gate;
use URL;
use Session;
class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */

    protected $loginView;

    protected $username='login';

    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {


        $this->middleware('guest')->except('logout');

        $this->loginView = env('THEME').'.login';
    }

    public function redirectPath()
    {

        return Session::get('backUrl') ? Session::get('backUrl') : $this->redirectTo;
    }

    public function username()
    {
        return $this->username;
    }



    public function showLoginForm()
    {
        $view = property_exists($this, 'loginView')
            ? $this->loginView : '';

        if (view()->exists($view)) {
           if(URL::current()!==URL::previous()){
            \Session::put('backUrl', URL::previous());
           }
            return view($view)->with('title', 'Вход на сайт');
        }

        abort(404);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

}