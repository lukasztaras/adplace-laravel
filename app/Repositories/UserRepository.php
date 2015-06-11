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
    
}