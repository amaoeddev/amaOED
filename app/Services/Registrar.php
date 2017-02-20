<?php namespace App\Services;

use App\User;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

class Registrar implements RegistrarContract {

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
		return Validator::make($data, [
			'fname' => 'required|max:255',
                        'lname' => 'required|max:255',
                        'country' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
                        'g-recaptcha-response' => 'required|captcha',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{
		return User::create([
			'fname' => $data['fname'],
                        'mname' => $data['mname'],
                        'lname' => $data['lname'],
                        'gender' => $data['gender'],
                        'birthdate'=> $data['birthdate'],
                        'addr1' => $data['addr1'],
                        'addr2' => $data['addr2'],
                        'city' => $data['city'],
                        'state' => $data['state'],
                        'country' => $data['country'],
                        'zip' => $data['zip'],
                        'phone' => $data['phone'],
                        'mobile' => $data['mobile'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
		]);
	}

}
