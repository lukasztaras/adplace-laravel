<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];
        
        /**
         * Get Logged-In UserID
         */
        public function getId()
        {
            return $this->id;
        }
        
        /**
         * Check if user belongs to specified role
         */
        public function inRole($role)
        {
            // let's get all roles from the system
            $roles = Roles::firstByAttributes(array(
                'name' => $role
            ));
            
            // if role by specified name does not exist - return false
            if (empty($roles))
            {
                return false;
            }
            
            $roleId = $roles->getId();
            $userId = $this->getId();
            
            $userRoles = Userroles::firstByAttributes(array(
                'user_id' => $userId,
                'role_id' => $roleId
            ));
            
            // if user does not belong to requested role return false
            if (empty($userRoles))
            {
                return false;
            }
            
            return true;
        }

}
