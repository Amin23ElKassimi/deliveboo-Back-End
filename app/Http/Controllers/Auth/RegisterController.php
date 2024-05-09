<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = '/admin/restaurants/create';

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
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^(?=.*[A-Z])(?=.*[!@#$%^&*(),.?":{}|<>])/', 'regex:/^(?=.*[A-Z])/',],
        ], [
            'name.required' => 'Il campo nome è obbligatorio.',
            'name.min' => 'Il campo nome deve essere lungo almeno :min caratteri.',
            'name.max' => 'Il campo nome non può superare :max caratteri.',
            'last_name.required' => 'Il campo cognome è obbligatorio.',
            'last_name.max' => 'Il campo cognome non può superare :max caratteri.',
            'email.required' => 'Il campo email è obbligatorio.',
            'email.email' => 'Inserisci un indirizzo email valido.',
            'email.max' => 'Il campo email non può superare :max caratteri.',
            'email.unique' => 'Questo indirizzo email è già in uso.',
            'password.required' => 'Il campo password è obbligatorio.',
            'password.min' => 'La password deve essere lunga almeno :min caratteri.',
            'password.confirmed' => 'La conferma della password non corrisponde.',
            'password.regex' => 'La password deve contenere almeno un carattere speciale !@#$%^&*(),.?":{} ed almeno una lettera maiuscola'
        ]);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
