<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Request as MyRequest;
use Illuminate\Support\Facades\Redirect;
use App\Tags;
use App\User;

class AdminController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
            $this->middleware('auth');
            
            if (Auth::user()->inRole('administrator') === false)
            {
                return Redirect::to('/')->send();
            }
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
            return view('admin/admin');
	}
        
        /**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function tags()
	{
            $tags = \App\Tags::all();
            return view('admin/admintags', array(
                'tags' => $tags
            ));
	}
        
        /**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function tagsPost()
	{
            Tags::where('enabled', 1)->update(array('enabled' => 0));
            
            // let's get all tags we want to set to enabled
            $tags = MyRequest::all();
            foreach($tags as $key => $tag) 
            {
                Tags::where('id', $key)->update(array('enabled' => 1));
            }
            
            return Redirect::to('admin/tags')->send();
	}
        
        /**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function users()
	{
            $users = \App\User::all();
            return view('admin/adminusers', array(
                'users' => $users
            ));
	}
        
        /**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function usersPost()
	{
            User::where('enabled', 1)->update(array('enabled' => 0));
            
            // let's get all tags we want to set to enabled
            $users = MyRequest::all();
            var_dump($users);
            foreach($users as $key => $user) 
            {
                User::where('id', $key)->update(array('enabled' => 1));
            }
            
            return Redirect::to('admin/users')->send();
	}

}
