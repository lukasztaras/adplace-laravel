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
            
            if (Auth::check() && Auth::user()->inRole('administrator') === false)
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
	 * Show all available tags
	 *
	 * @return Response
	 */
	public function tags()
	{
            $tags = Tags::all();
            
            return view('admin/tags', array(
                'tags' => $tags
            ));
	}
        
        /**
	 * Process Request of editing tags
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
	 * Show all available users
	 *
	 * @return Response
	 */
	public function users()
	{
            $users = User::all();
            
            return view('admin/users', array(
                'users' => $users
            ));
	}
        
        /**
	 * Process request of editing users
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
	 * Edit existing advertisement
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
            
            return view('admin/adverts/edit', array(
                'ad' => $advert
            ));
	}
        
        /**
	 * Process request of editing advertisement
	 *
	 * @return Response
	 */
	public function advertsEditPost(MyRequest $request)
	{
            $request = $request::all();
            $advert = Adverts::find($request['adId']);
            
            if ($advert == null)
            {
                return redirect()->back()->withErrors(array('Incorrect Advertisement Id'));
            }
            
            $advert->title = $request['name'];
            $advert->description = $request['desc'];
            $advert->color = $request['color'];
            $advert->city = $request['city'];
            $advert->hashtag = $request['hash'];
            $advert->save();
            
            return redirect()->back()->withErrors(array('Advertisement successfully modified'));
	}

}
