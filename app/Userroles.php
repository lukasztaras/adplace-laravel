<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Userroles extends Model {
    protected $table = 'user_roles';
    public $timestamps = false;
    protected $fillable = array('user_id', 'role_id');
}
