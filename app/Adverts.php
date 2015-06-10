<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Adverts extends Model {
    protected $table = 'adverts';
    public $timestamps = false;
    protected $fillable = array('title', 'description', 'city', 'color', 'hashtag', 'added', 'expires', 'user_id');
    
    public function user() {
        return $this->belongsTo('App\User');
    }
}
