<?php

namespace App\Repositories;

use App\User;
use Auth;

class UserRepository implements RepositoryInterface {
    
    private $authenticatedUser = null;
    
    public function __construct() {
        if (Auth::check())
        {
            $this->authenticatedUser = Auth::user();
        }
    }
    
    public function getAll() {
        return User::all();
    }
    
    public function getById($id) {
        return User::find($id);
    }
    
    public function getAuthenticatedUser()
    {
        return $this->authenticatedUser;
    }
    
    public function disableAllUsers()
    {
        User::where('enabled', 1)->update(array('enabled' => 0));
    }
    
    public function enableUserById($id)
    {
        User::where('id', $id)->update(array('enabled' => 1));
    }
    
}