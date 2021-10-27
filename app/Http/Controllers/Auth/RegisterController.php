<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'dui' => 'required|string|max:10',/* Nuevo para dui */
            'nombre' => 'required|string|max:40|',/* Nuevo */
            'apellido' => 'required|string|max:50|',/* Nuevo */
            'nit' => 'required|string|max:17|',/* Nuevo */
            'fechaNacimiento' => 'required|string|min:10|',/* Nuevo */
            //'estado' => 'required|boolean|',/* Ojo con boolean posible error */
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        //dd($data);
        return User::create([
            'dui' => $data['dui'],/* Nuevo para dui */
            'nombre' => $data['nombre'],/* Nuevo */
            'apellido' => $data['apellido'],/* Nuevo */
            'nit' => $data['nit'],/* Nuevo */
            'fechaNacimiento' => $data['fechaNacimiento'],/* Nuevo */
            'estado' => $data['estado'] ? true : false,/* Nuevo con ? true : false; comprueba si se a accionado el check , si no se envia lo toma como falso  */
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
