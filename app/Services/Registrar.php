<?php namespace App\Services;

use App\User;
use App\Roles;
use App\Userroles;
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
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
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
            $newUser = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),
            ]);
            
            // let's put that user in advertiser role
            $role = Roles::all()->where('name', 'advertiser')->first();
            Userroles::create(array(
                'user_id' => $newUser->id,
                'role_id' => $role->id
            ))->save();
            
            return $newUser;
	}

}
