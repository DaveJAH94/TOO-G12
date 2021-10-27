<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    //inicio de la funcion copiada del codigo fuentre de laravel vendor
    
    //fin de funcion copiada del codigo fuente de laravel en vendor/framework/src/illuminate

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';//modificado antes solo era /  
    //cuando se autentifique mandara al /home que es donde esta la primera vista con componentes
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function logout () {
        //logout user
        auth()->logout();
        // redirect to homepage
        return redirect('/login');
    }
    public function logeoInicial () {
        return redirect('/login');
    }
    
}
