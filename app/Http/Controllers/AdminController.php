<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Request as MyRequest;
use Illuminate\Support\Facades\Redirect;
use App\Tags;
use App\User;
use App\Adverts;

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
        
        /**
	 * List of all advertisements
	 *
	 * @return Response
	 */
	public function adverts()
	{
            $today = new \DateTime();
            $adverts = Adverts::where('expires', '>', $today)->paginate(15);
            
            return view('admin/adverts', array(
                'ads' => $adverts
            ));
	}
        
        /**
	 * Delete advertisement
	 *
	 * @return Response
	 */
	public function advertsDelete($var)
	{
            $advert = Adverts::find($var);
            if ($advert == null)
            {
                return redirect()->back()->withErrors(array('Incorrect Advertisement Id'));
            }
            
            $advert->delete();
            return redirect()->back()->withErrors(array('Advertisement successfully deleted'));
	}
        
        /**
	 * Delete advertisement
	 *
	 * @return Response
	 */
	public function advertsEdit($var)
	{
            $advert = Adverts::find($var);
            if ($advert == null)
            {
                return redirect()->back()->withErrors(array('Incorrect Advertisement Id'));
            }
            
            return view('admin/advertsedit', array(
                'ad' => $advert
            ));
	}
        
        /**
	 * Edit advertisement
	 *
	 * @return Response
	 */
	public function advertsEditPost(Request $request)
	{
            $advert = Adverts::find($var);
            if ($advert == null)
            {
                return redirect()->back()->withErrors(array('Incorrect Advertisement Id'));
            }
            
            $request = $request::all();
            $advert->title = $request['name'];
            $advert->description = $request['desc'];
            $advert->color = $request['city'];
            $advert->city = $request['color'];
            $advert->hashtag = $request['hash'];
            $advert->save();
            
            return redirect()->back()->withErrors(array('Advertisement successfully modified'));
	}

}
