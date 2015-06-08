<?php 

namespace App\Http\Controllers;

use Auth;
use Request;
use Validator;
use Illuminate\Support\Facades\Redirect;
use \App\Adverts;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
            return view('home');
	}
        
        /**
	 * Form to add new Advertisement
	 *
	 * @return Response
	 */
	public function newAd()
	{
            // we need to get list of Tags so
            $tags = \App\Tags::all();
            
            $enabledTags = array();
            foreach ($tags as $tag)
            {
                $enabledTags[$tag->name] = $tag->enabled;
            }
            
            return view('newad', array(
                'tags' => $enabledTags
            ));
	}
        
        /**
	 * Process request of adding new advertisement
	 *
	 * @return Response
	 */
	public function newAdPost(Request $request)
	{
            $validator = Validator::make($request::all(),[
                'name' => 'required',
                'desc' => 'required'
            ]);
            
            if ($validator->fails())
            {
                return redirect()->back()->withErrors($validator->errors());
            }
            
            // validator passed, let's add that ad and display success message
            $dateToday = new \DateTime();
            $nextWeek = new \DateTime();
            $nextWeek->add(new \DateInterval('P1W'));
            
            $request = $request::all();
            
            if (!isset($request['city']))
                $request['city'] = 'undefined';
            
            if (!isset($request['color']))
                $request['color'] = 'undefined';
            
            if (!isset($request['hash']))
                $request['hash'] = 'undefined';
            
            $advert = Adverts::create(array(
                'title'         => $request['name'],
                'description'   => $request['desc'],
                'added'         => $dateToday,
                'expires'       => $nextWeek,
                'user_id'       => Auth::user()->id,
                'city'          => $request['city'],
                'color'         => $request['color'],
                'hashtag'       => $request['hash']
            ));
            
            $advert->save();
            
            return redirect()->back()->withErrors(['Advertisement successfully added']);
	}
        
        /**
	 * List of advertisements
	 *
	 * @return Response
	 */
	public function ads()
	{
            // we need to get list of Tags so
            $ads = Adverts::all()->where('user_id', Auth::user()->id);
            
            return view('listads', array(
                'ads' => $ads
            ));
	}

}
